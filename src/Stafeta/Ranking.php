<?php

namespace Stafeta;

use PDO;

define('RAID_SCORE_INITIAL', 5000);
define('RAID_PENALTY_PER_MINUTE', 10);
define('RAID_PENALTY_PER_MISSING_ITEM', 5);
define('RAID_PENALTY_MINUMUM_DISTANCE', 300);
define('BONUS_TEAM_SCORE', 10);


class Ranking {
    /**
     * Stupid ranking function
     * If $scoringField is provided, it will rank teams having the same $scoringFields with the same rank
     *
     * @param $items
     * @param null $scoringFields
     * @return mixed
     */
    public static function rank($items, $scoringFields = null)
    {
        if (!is_array($items)) {
            $items = array();
        }

        if ($scoringFields !== null && !is_array($scoringFields)) {
            $scoringFields = array($scoringFields);
        }

        $rank = 0;
        $prevScoringValues = null;
        foreach ($items as $teamId => $team) {
            if ($scoringFields !== null) {
                if ($prevScoringValues !== null) {
                    $match = true;
                    foreach ($scoringFields as $field) {
                        if ($prevScoringValues[$field] != $team[$field]) {
                            $match = false;
                        }
                    }
                    if (!$match) {
                        $rank++;
                    }
                } else {
                    $rank++;
                }
                foreach ($scoringFields as $field) {
                    $prevScoringValues[$field] = $team[$field];
                }
            } else {
                $rank++;
            }


            $team['rank'] = $rank;
            $items[$teamId] = $team;
        }


        return $items;
    }

    /**
     * Settles ties based on the following rules:
     * 1. La raid in caz de egalitate nu mai e dupa orientare ci dupa cel mai bun timp scos de la start pana la finish (Raid).
     * <s>(Removed) 1. (Raid) In caz de egalitate intre doua sau mai multe cluburi, departajarea acestora se va realiza in functie de cel mai mic timp obtinut la proba de orientare.</s>
     *
     * @param $teams
     *
     * @return array
     */
    public static function settleTies($teams)
    {
        $prevRank = null;
        $prevScore = null;
        $prevTeam = null;
        $hadTies = false;
        $ranks = array();

        foreach ($teams as $teamId => $team) {
            $ranks[] = $team['rank'];

            if ($prevRank !== null) {
                if ($team['rank'] == $prevRank) {
                    $hadTies = true;
                    $aid = $team['team_id'];
                    $bid = $prevTeam['team_id'];
                    $ta = strtotime($team['total']);
                    $tb = strtotime($prevTeam['total']);
                    if ($ta > $tb) {
                        $teams[$aid]['rank']++;
                    } else {
                        $teams[$bid]['rank']++;
                    }
                }
            }
            $prevRank = $team['rank'];
            $prevTeam = $team;
        }

//        $teams = Utils::multiSort($teams, array('score' => SORT_DESC, 'orienteering_total_time' => SORT_ASC), 'team_id');
        $teams = Utils::multiSort($teams, array('score' => SORT_DESC, 'raid_total_time' => SORT_ASC), 'team_id');

        if ($hadTies) {
            return self::settleTies($teams);
        }

        return $teams;
    }


    /**
     * Computes score for Raid challenge
     *
     * @param $categoryId
     * @param $teams
     * @return array
     * @throws \Exception
     */
    public static function raidAll($categoryId, $teams)
    {
        $_teams = $teams;
        $teams = array();
        foreach ($_teams as $i => $team) {
            $score = self::raid($team);
            $team['score'] = $score;
            $teams[$team['team_id']] = $team;
        }
        $orienteering = self::orienteering($categoryId);
        foreach ($teams as $teamId => $team) {
            $time = '23:59:59';
            $teams[$teamId]['orienteering_time'] = $time;
            $teams[$teamId]['orienteering_total_time'] = strtotime($time);
        }

        foreach ($orienteering as $k => $v) {
            $orienteeringAbandonment = false;
            if ($v['abandon'] == 1 || $v['missed_posts'] >= 1) {
                $time = '23:59:59';
                $orienteeringAbandonment = true;
            } else {
                $time = $v['total'];
            }

            $teams[$v['team_id']]['orienteering_time'] = $time;
            $teams[$v['team_id']]['orienteering_total_time'] = strtotime($time);
            $teams[$v['team_id']]['orienteering_abandonment'] = $orienteeringAbandonment;
        }

        $teams = fn_sort_array_by_key($teams, 'score', SORT_DESC);

        $teams = self::settleTies($teams);
        $teams = self::rank($teams, array('score', 'raid_total_time'));

        return $teams;
    }

    /**
     * Computes the score of a single team for the Raid challenge
     *
     * @param $team
     * @return float|int
     * @throws \Exception
     */
    public static function raid(&$team)
    {
        global $odb;

        $challengeId = 1;
        $team = is_array($team) ? $team : Team::get($team);
        $teamId = $team['team_id'];
        $categoryId = $team['category_id'];
        $category = Category::get($categoryId);



        $categoryChallenge = CategoryChallenge::getByIds($categoryId, $challengeId);
        $categoryChallengeId = $categoryChallenge['category_challenge_id'];
        $team['participation'] = $participation = Participation::getByIds($teamId, $categoryChallengeId);
        $participationId = $participation['participation_id'];

        $team['abandonment'] = $participation['abandonment'];
        $team['logs'] = array();

        if ($participation['abandonment']) {
            $team['logs'][] = 'Abandonare; scor: 0';
            return 0;
        }
        $entries = Participation::getEntries($participationId);

        $score = RAID_SCORE_INITIAL;


        // compute penalties based on rule: 5. Regula lipsa bonaci (art. 8.3.7.)
        if (!empty($participation['missing_footwear'])) {
            $penalty = $score;
            $score0 = $score;
            $score -= $penalty;
            $team['logs'][] = sprintf('Descalificare din cauza lipsei incaltamintei; scor: %s - %s = %s'
                , $score0
                , $penalty
                , $score
            );

            return $score;
        }


        // compute penalties based on rule: 4. Reguli lipsa echipamente (art. 8.3.6.)
        if (!empty($participation['missing_equipment_items'])) {
            $missingItems = intval($participation['missing_equipment_items']);
            if (empty($missingItems)) {
                throw new \Exception('Participation configuration error: invalid number of missing equipment items');
            }
            $penaltyPerItem = RAID_PENALTY_PER_MISSING_ITEM;
            $penalty = $missingItems * $penaltyPerItem;
            $score0 = $score;
            $score -= $penalty;
            $team['logs'][] = sprintf('Penalizare lipsa echipamente (%s articole); scor: %s - %s = %s'
                , $missingItems
                , $score0
                , $penalty
                , $score

            );
        }

        // compute penalties based on rule: 6. Regula nerespectare distanta minima echipaj (art. 8.3.10.)
        if (!empty($participation['minimum_distance_penalty'])) {
            $penalty = RAID_PENALTY_MINUMUM_DISTANCE;
            $score0 = $score;
            $score -= $penalty;
            $team['logs'][] = sprintf('Penalizare nerespectare distanta minima membrii; scor: %s - %s = %s'
                , $score0
                , $penalty
                , $score
            );
        }





        $finishEntries = array();
        $timeline = array();
        foreach ($entries as $entry) {
            if (in_array($entry['station_type'], array(Station::TYPE_PA, Station::TYPE_START, Station::TYPE_FINISH))) {
                $x = stringToSeconds($entry['time_start']);
                $y = stringToSeconds($entry['time_finish']);

                $sx = ($entry['time_start']);
                $sy = ($entry['time_finish']);

                if (!empty($y)) {
                    if (isset($finishEntries[$sy])) {
                        throw new \Exception('Space-time continuum error: a team cannot finish two (or more) stations in the same time (ie. finish time)!');
                    }
                    $finishEntries[$sy] = $entry;
                }


                if (in_array($entry['station_type'], array(Station::TYPE_START))) {
                    if (empty($x)) {
                        throw new \Exception('Error: invalid start time');
                        continue;
                    }
                    $timeline[] = $sx;
                }

                if (in_array($entry['station_type'], array(Station::TYPE_FINISH))) {
                    if (empty($y)) {
                        throw new \Exception('Error: invalid finish time');
                        continue;
                    }
                    $timeline[] = $sy;
                }

                if (in_array($entry['station_type'], array(Station::TYPE_PA))) {
                    if (empty($x) || empty($y)) {
                        throw new \Exception('Error: invalid start/finish time');
                        continue;
                    }
                    $timeline[] = $sy;
                    $timeline[] = $sx;
                }
            }
        }

        // compute score based on time between PA stations
        $penaltyPerMinute = RAID_PENALTY_PER_MINUTE;
        $timelineEntries = count($timeline);
        $totalTime = 0;
        for ($i = 0; $i < $timelineEntries; $i+=2) {

            $sx = $timeline[$i];
            $sy = $timeline[$i + 1];

            $x = stringToSeconds($sx);
            $y = stringToSeconds($sy);

            $delta = $y - $x;

            if (!isset($finishEntries[$sy])) {
                throw new \Exception('Amnesic error: cannot recall timeline entry');
            }

            if ($i > $timelineEntries) {
                throw new \Exception('Invalid number of timeline entries!');
            }

            if (empty($delta)) {
                throw new \Exception('Space-time continuum error: time traveling not possible at the moment, hence a team cannot travel the distance between two stations (or from start to finish) instantaneously (ie. start time cannot equal finish time)');
            }

            $entry = $finishEntries[$sy];
            $maxTime = $entry['maximum_time']; // these are expressed in minutes for some reason, so slap that var with some basic arithmetic multiplication

            $totalTime += $delta; // add up to total Raid time (seconds)

            $delta = ceil($delta / 60);


            if ($delta > $maxTime) {
                $overflow = $delta - $maxTime;
                $penalty = ($overflow * $penaltyPerMinute);
                $score0 = $score;
                $score -= $penalty;
                $team['logs'][] = sprintf('Penalizare depasire timp maxim %s (%s min) cu %s min; scor: %s - %s = %s'
                    , $entry['label']
                    , $entry['maximum_time']
                    , $overflow
                    , $score0
                    , $penalty
                    , $score

                );
            }
        }

        $totalTimeText = secondsToString($totalTime);
        $team['raid_total_time'] = $totalTime;
        $team['raid_total_time_text'] = $totalTimeText;
        $team['raid_total_time_text_log'] = sprintf('Total timp raid (fara pauzele dintre posturi): %s (sau %s secunde)', $totalTimeText, $totalTime);

        // compute score based on PFA hits
        foreach ($entries as $entry) {
            if (in_array($entry['station_type'], array(Station::TYPE_PFA))) {
                if (empty($entry['hits'])) {
                    if (empty($entry['score'])) {
                        throw new \Exception('Station configuration error: invalid penalty score defined');
                    }
                    $penalty = $entry['score'];
                    $score0 = $score;
                    $score -= $penalty;
                    $team['logs'][] = sprintf('Penalizare ratare %s cu %s puncte; scor: %s - %s = %s'
                        , $entry['label']
                        , $penalty
                        , $score0
                        , $penalty
                        , $score
                    );
                }
            }
        }


        if ($score < 0) {
            $score = 0;
        }

        /*
         * -5 puncte la echipament lipsa ?
         * 1 articol?
         * -300 puncte daca nu respecta distanta
         */

        return $score;

    }


    /**
     * @TODO: to be removed
     *
     * @param $categoryId
     * @return array
     */
    public static function orienteeringObsolete($categoryId)
    {
        static $cache = array();
        if (isset($cache[$categoryId])) {
            return $cache[$categoryId];
        }

        global $odb;

        $sql = "
			SELECT
                teams.team_id,
                teams.team_name,
                categories.category_name,
                orienteering.orienteering_id,
                orienteering.name_participant,
                orienteering.start,
                orienteering.finish,
                orienteering.total,
                orienteering.abandon,
                orienteering.missed_posts
			FROM teams
			INNER JOIN categories ON categories.category_id = teams.category_id
			LEFT JOIN orienteering ON orienteering.team_id = teams.team_id
			WHERE teams.category_id = :category_id
			ORDER BY orienteering.abandon, orienteering.missed_posts, orienteering.total ASC
			";
        $statement = $odb->prepare($sql);
        $statement->bindValue(":category_id", $categoryId);
        $statement->execute();
        $orienteering = $statement->fetchAll(PDO::FETCH_ASSOC);



        foreach ($orienteering as $orientare) {

            if ($orientare['abandon'] == 1 || $orientare['missed_posts'] >= 1 || empty($orientare['orienteering_id'])) {
                $time = '23:59:59';
                $score = 0;
                $seconds = strtotime($time);
                $difference = 0;
            } else {
                $time = $orientare['total'];

                // convert into a timestamp
                $seconds = strtotime($time);

                // calculate difference between this time, and first place.
                // on the first loop, we are looking at 1st place, so the difference is 0.
                $difference = isset($results) ?
                    $results[0]["seconds"] - $seconds :
                    0;
                // absolute value
                $difference = abs($difference);

                // calculate score:
                // on the first loop, we are looking at 1st place (5000 points),
                // otherwise -1 point for every second behind 1st place.
                $score = isset($results) ?
                    5000 - $difference :
                    5000;
            }






            $result = array_merge($orientare, array(
                "time" => $time,        // time
                "seconds" => $seconds,
                "difference" => $difference,  // difference in seconds from 1st place
                "score" => $score        // total score
            ));

            // collect results in an array.
            $results[] = $result;

        }
        $results = is_array($results) ? $results : array();

        $cache[$categoryId] = $results;


        return $results;

    }

    // Orienteering ranking
    public static function orienteering($categoryId)
    {
        global $odb;

        // get the first place
        $sql = "
            SELECT
                teams.team_id,
                teams.club_id,
                teams.team_name,
                categories.category_name,
                orienteering.orienteering_id,
                orienteering.name_participant,
                orienteering.start,
                orienteering.finish,
                orienteering.total,
                orienteering.abandon,
                orienteering.missed_posts,
                TIME_TO_SEC(orienteering.total) as orienteering_seconds,
                knowledge.answers,
                knowledge.time AS knowledge_time,
                knowledge.abandon,
                knowledge.scor
            FROM teams
                INNER JOIN categories ON
                    categories.category_id = teams.category_id
                LEFT JOIN orienteering ON
                    orienteering.team_id = teams.team_id
                LEFT JOIN knowledge ON
                    knowledge.team_id = teams.team_id
            WHERE
                teams.category_id = :category_id
                AND orienteering.abandon = 0
                AND orienteering.missed_posts = 0
            ORDER BY orienteering.total ASC
        ";
        $statement = $odb->prepare($sql);
        $statement->bindValue(":category_id", $categoryId);
        $statement->execute();
        $firstPlace = $statement->fetch(PDO::FETCH_ASSOC);
        $firstPlaceSeconds = $firstPlace['orienteering_seconds'];
        $firstPlaceSeconds = empty($firstPlaceSeconds) ? 0 :  $firstPlaceSeconds;


        // get all places and compute score based on first place
        $sql = "
            SELECT
                teams.team_id,
                teams.club_id,
                teams.team_name,
                categories.category_name,
                orienteering.orienteering_id,
                orienteering.name_participant,
                orienteering.start,
                orienteering.finish,
                orienteering.total,
                orienteering.abandon as orienteering_abandon,
                orienteering.missed_posts,
                TIME_TO_SEC(orienteering.total) as orienteering_seconds,
                (TIME_TO_SEC(orienteering.total) - $firstPlaceSeconds) AS orienteering_difference,
                IF (
                    orienteering.abandon = 0 AND orienteering.missed_posts = 0,
                    (5000 - (TIME_TO_SEC(orienteering.total) - $firstPlaceSeconds)),
                    0
                ) AS orienteering_score,
                knowledge.answers,
                knowledge.time AS knowledge_time,
                knowledge.abandon as knowledge_abandon,
                knowledge.scor AS knowledge_score,
                IF (
                    orienteering.abandon = 0 AND orienteering.missed_posts = 0,
                    (5000 - (TIME_TO_SEC(orienteering.total) - $firstPlaceSeconds)),
                    0
                ) AS score
            FROM teams
                INNER JOIN categories ON
                    categories.category_id = teams.category_id
                LEFT JOIN orienteering ON
                    orienteering.team_id = teams.team_id
                LEFT JOIN knowledge ON
                    knowledge.team_id = teams.team_id
            WHERE
                teams.category_id = :category_id
            ORDER BY score DESC, orienteering.abandon, orienteering.missed_posts, orienteering.total ASC
	";
        $statement = $odb->prepare($sql);
        $statement->bindValue(":category_id", $categoryId);
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $items;
    }

    // General category ranking
    public static function generalCategory($categoryId)
    {
        global $odb;

        // get the first place
        $sql = "
            SELECT
                teams.team_id,
                teams.club_id,
                teams.team_name,
                categories.category_name,
                orienteering.orienteering_id,
                orienteering.name_participant,
                orienteering.start,
                orienteering.finish,
                orienteering.total,
                orienteering.abandon,
                orienteering.missed_posts,
                TIME_TO_SEC(orienteering.total) as orienteering_seconds,
                knowledge.answers,
                knowledge.time AS knowledge_time,
                knowledge.abandon,
                knowledge.scor
            FROM teams
                INNER JOIN categories ON
                    categories.category_id = teams.category_id
                LEFT JOIN orienteering ON
                    orienteering.team_id = teams.team_id
                LEFT JOIN knowledge ON
                    knowledge.team_id = teams.team_id
            WHERE
                teams.category_id = :category_id
                AND orienteering.abandon = 0
                AND orienteering.missed_posts = 0
            ORDER BY orienteering.total ASC
        ";
        $statement = $odb->prepare($sql);
        $statement->bindValue(":category_id", $categoryId);
        $statement->execute();
        $firstPlace = $statement->fetch(PDO::FETCH_ASSOC);
        $firstPlaceSeconds = $firstPlace['orienteering_seconds'];
        $firstPlaceSeconds = empty($firstPlaceSeconds) ? 0 :  $firstPlaceSeconds;


        // get all places and compute score based on first place
        $sql = "
            SELECT
                teams.team_id,
                teams.club_id,
                teams.team_name,
                categories.category_name,
                orienteering.orienteering_id,
                orienteering.name_participant,
                orienteering.start,
                orienteering.finish,
                orienteering.total,
                orienteering.abandon as orienteering_abandon,
                orienteering.missed_posts,
                TIME_TO_SEC(orienteering.total) as orienteering_seconds,
                (TIME_TO_SEC(orienteering.total) - $firstPlaceSeconds) AS orienteering_difference,
                IF (
                    orienteering.abandon = 0 AND orienteering.missed_posts = 0,
                    (5000 - (TIME_TO_SEC(orienteering.total) - $firstPlaceSeconds)),
                    0
                ) AS orienteering_score,
                knowledge.answers,
                knowledge.time AS knowledge_time,
                knowledge.abandon as knowledge_abandon,
                knowledge.scor AS knowledge_score,
                IF (
                    orienteering.abandon = 0 AND orienteering.missed_posts = 0,
                    ((5000 - (TIME_TO_SEC(orienteering.total) - $firstPlaceSeconds)) + knowledge.scor),
                    knowledge.scor
                ) AS score
            FROM teams
                INNER JOIN categories ON
                    categories.category_id = teams.category_id
                LEFT JOIN orienteering ON
                    orienteering.team_id = teams.team_id
                LEFT JOIN knowledge ON
                    knowledge.team_id = teams.team_id
            WHERE
                teams.category_id = :category_id
            ORDER BY score DESC, orienteering.abandon, orienteering.missed_posts, orienteering.total ASC
	";
        $statement = $odb->prepare($sql);
        $statement->bindValue(":category_id", $categoryId);
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $items;
    }
    public static function generalCategorySetup($categoryId)
    {

        $generalRanking = Ranking::generalCategory($categoryId);
        $generalRanking = Utils::setArrayKey($generalRanking, 'team_id');

        $raidChallengeId = 1;
        $categoryChallenge = CategoryChallenge::getByIds($categoryId, $raidChallengeId);
        $categoryChallengeId = $categoryChallenge['category_challenge_id'];
        $teams = Teams::getByCategoryChallengeId($categoryChallengeId);

        $raidRanks = Ranking::raidAll($categoryId, $teams);
        $raidRanks = Utils::setArrayKey($raidRanks, 'team_id');

        foreach ($generalRanking as $teamId => $team) {
            if (!isset($raidRanks[$teamId])) {
                throw new \Exception('Nu au fost introduse rezultatele etapei "Raid Montan" pentru echipa "' . $team['team_name'] . '"');
            }
            $team['raid_score'] = $raidRanks[$teamId]['score'];
            $team['score'] += $team['raid_score'];
            $team['raid_abandon'] += $raidRanks[$teamId]['abandonment'];
            $team['missing_footwear'] = $raidRanks[$teamId]['participation']['missing_footwear'];
            $generalRanking[$teamId] = $team;
        }

        $generalRanking = Utils::multiSort($generalRanking, array('score' => SORT_DESC), 'team_id');
        $generalRanking = Ranking::rank($generalRanking, 'score');


        $generalRanking = self::generalSM($categoryId, $generalRanking);
        $generalRanking = Utils::multiSort($generalRanking, array('sm_score' => SORT_DESC), 'team_id');
        $generalRanking = Ranking::rank($generalRanking, 'sm_score');

        return $generalRanking;
    }

    /**
     * Computes the General ranking
     *
     * @param $categoryId
     * @param $items
     * @return mixed
     */
    public static function generalSM($categoryId, $items)
    {
        $scoring = array(
            'initial' => 500,
            'initial_elite' => 550,
            'initial_open' => 400,
            'first_step' => 20,
            'step' => 10,
            'abandonment_penalty' => 100,

        );

        // Open
        if ($categoryId == 4) {
            $scoring['initial'] = $scoring['initial_open'];
        }

        // Elite
        if ($categoryId == 3) {
            $scoring['initial'] = $scoring['initial_elite'];
        }

        $organizer = Organizer::getInstance();
        if ($organizer->isChallenge() || $organizer->isAmical()) {
            foreach ($scoring as $k => $v) {
                $scoring[$k] = $v / 2;
            }
        }

        $score = $scoring['initial'];
        $previousRank = null;
        foreach ($items as $teamId => $team) {
            $rank = $team['rank'];
            $abandonments = 0;
            $penalties = 0;
            if (!empty($team['orienteering_abandon'])) {
                $abandonments++;
            }
            if (!empty($team['knowledge_abandon']) || $team['knowledge_score'] <= 0) {
                $abandonments++;
            }
            if (!empty($team['raid_abandon']) || $team['raid_score'] <= 0) {
                $abandonments++;
            }

            if (!empty($abandonments)) {
                $penalties = $abandonments * $scoring['abandonment_penalty'];
            }

            if ($previousRank === null || $previousRank != $rank) {
                if ($rank == 1) {
                } else if ($rank == 2) {
                    $score -= $scoring['first_step'];
                } else {
                    $score -= $scoring['step'];
                }
            }            

            $_score = $score - $penalties;
            if ($_score < 0) {
                $_score = 0;
            }
            if ($abandonments == 3) {
                $_score = 0;
            }

            $team['sm_score'] = $_score;

            $items[$teamId] = $team;
            $previousRank = $rank;
        }

        return $items;
    }


    // General ranking
    public static function general()
    {
        $clubs = Clubs::get();
        $clubs = Utils::setArrayKey($clubs, 'club_id');

        $teams = Teams::get();
        $teams = Clubs::groupTeamsByClub($teams);

        $categories = Categories::get(true);

        $totalCategories = count($categories);

        $generalCategories = array();
        foreach ($categories as $category) {
            $categoryId = $category['category_id'];
            $generalCategories[$categoryId] = self::generalCategorySetup($categoryId);
        }

        foreach ($generalCategories as $categoryId => $generalCategory) {
            foreach ($clubs as $club) {
                $clubId = $club['club_id'];
                $clubTeams = $teams[$clubId];
                if (!is_array($clubTeams)) {
                    $clubTeams = array();
                }

                if (!isset($clubs[$clubId]['ranking'])) {
                    $clubs[$clubId]['ranking'] = array();
                }

                $scores = array();
                foreach ($clubTeams as $team) {
                    $teamId = $team['team_id'];
                    if (!isset($generalCategory[$teamId])) {
                        continue;
                    }
                    $scores[$teamId] = $generalCategory[$teamId]['sm_score'];
                }
                $maxScore = empty($scores) ? 0 : max($scores);
                $clubs[$clubId]['ranking'][$categoryId] = $maxScore;


                // compute bonus for each club
                $bonus = 0;
                $bonusScore = BONUS_TEAM_SCORE;

                foreach ($clubTeams as $teamId => $team) {


                    if (!isset($generalCategory[$teamId])) {
                        continue;
                    }
                    $entry = $generalCategory[$teamId];

                    if (
                        !empty($entry['raid_abandon'])
                        || !empty($entry['knowledge_abandon'])
                        || !empty($entry['orienteering_abandon'])
                        || !empty($entry['missing_footwear'])
                    ) {
                        continue;
                    }

                    $bonus = $bonus + $bonusScore;
                }

                if (!isset($clubs[$clubId]['bonus'])) {
                    $clubs[$clubId]['bonus'] = 0;
                }
                $clubs[$clubId]['bonus'] += $bonus;
            }
        }

        foreach ($clubs as $clubId => $club) {
            $cats = 0;
            foreach ($club['ranking'] as $k => $v) {
                if (!empty($v)) {
                    $cats++;
                }
            }
            $acs = $club['ranking'];
            foreach ($acs as $k => $v) {
                if (empty($v)) {
                    unset($acs[$k]);
                }
            }
            $clubs[$clubId]['ignored_ranking'] = array();

            // allowed categories scores for computing the total (if club had teams in all 6 categories, we drop 2 worst scored categories from the total)
            if ($cats == $totalCategories) {
                asort($acs);
                $clubs[$clubId]['ignored_ranking'] = array_slice($acs, 0, 2, true);
                array_shift($acs);
                array_shift($acs);
            }
            if ($cats == $totalCategories - 1) {
                asort($acs);
                $clubs[$clubId]['ignored_ranking'] = array_slice($acs, 0, 1, true);
                array_shift($acs);
            }

            $clubs[$clubId]['total'] = $club['scor_cultural'] + $club['bonus'] + array_sum($acs);
        }

        $clubs = Utils::multiSort($clubs, array('total' => SORT_DESC));
        $clubs = Ranking::rank($clubs, array('total'));

        return $clubs;
    }

}