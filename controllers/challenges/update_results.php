<?php
/**
 * Created by PhpStorm.
 * User: WSergio
 * Date: 20/06/2015
 * Time: 17:42:37 PM
 */
use Stafeta\Category;
use Stafeta\CategoryChallenge;
use Stafeta\Challenge;
use Stafeta\Participation;
use Stafeta\Team;
use Stafeta\Teams;

global $odb, $smarty;
$categoryChallengeId = !empty($_REQUEST['category_challenge_id']) ? $_REQUEST['category_challenge_id'] : 0;
$categoryChallenge = CategoryChallenge::getById($categoryChallengeId);
$smarty->assign('categoryChallenge', $categoryChallenge);

$categoryId = !empty($categoryChallenge['category_id']) ? $categoryChallenge['category_id'] : 0;
$challengeId = !empty($categoryChallenge['challenge_id']) ? $categoryChallenge['challenge_id'] : 0;
$teamId = !empty($_REQUEST['team_id']) ? $_REQUEST['team_id'] : 0;

$challenge = Challenge::get($challengeId);
$category = Category::get($categoryId);

$smarty->assign('category_id', $categoryId);
$smarty->assign('challenge_id', $challengeId);
$smarty->assign('category', $category);
$smarty->assign('challenge', $challenge);

if (empty($categoryChallenge)) {
    $stations = array();
} else {
    $stations = CategoryChallenge::getStations($categoryChallenge['category_challenge_id']);
}
$smarty->assign('stations', $stations);

$team = Team::get($teamId);
$smarty->assign('team', $team);


$participation = Participation::getByIds($teamId, $categoryChallengeId);

$update = empty($_REQUEST['participation']) ? array() : $_REQUEST['participation'];
if (empty($participation)) {
    $participation = $update;
    $participation['team_id'] = $teamId;
    $participation['category_challenge_id'] = $categoryChallengeId;

    $entries = array();
    $participationId = 0;
} else {
    $participationId = $participation['participation_id'];
    $participation = array_merge($participation, $update);
    $entries = Participation::getEntries($participationId);
}


if ($_POST) {
    $entries = $_POST['entries'];
    Participation::update($participation, $entries);
	
		addSuccess("Modificările au fost salvate");
		
    redirect('challenges/results', array('category_id' => $categoryId, 'challenge_id' => 1));
}

if (empty($participation)) {
    $entries = array();
	
		addError("Modificările nu au fost salvate");
	
} else {
    $entries = Participation::getEntries($participationId);
}

// ugly, but we need it quick
$entrySationIds = array();
$stationIds = array();
$stationById = array();

if (!empty($entries)) {

    foreach ($entries as $entry) {
        $entrySationIds[] = $entry['station_id'];
    }

    $finish = null;
    foreach ($stations as $station) {
        if (!in_array($station['station_id'], $entrySationIds)) {
            if ($finish === null) {
                $finish = array_pop($entries);
            }
            $entries[] = $station;
        }
    }
    if ($finish !== null) {
        $entries[] = $finish;
    }
}

$smarty->assign('entries', $entries);
$smarty->assign('participation', $participation);
