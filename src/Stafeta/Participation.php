<?php


namespace Stafeta;

use Database;
use PDO;

class Participation {
    public static function getByIds($teamId, $categoryChallengeId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT * FROM participations WHERE team_id = :team_id AND category_challenge_id = :category_challenge_id");
        $statement->bindParam(":team_id", $teamId);
        $statement->bindParam(":category_challenge_id", $categoryChallengeId);
        $statement->execute();
        $item = $statement->fetch(PDO::FETCH_ASSOC);

        return $item;
    }
    public static function update($participation, $entries = null)
    {
        global $odb;

        $participationId = empty($participation) || empty($participation['participation_id']) ? 0 : $participation['participation_id'];

        if (empty($participationId)) {
            $participationId = \Database::insert('participations', $participation);
        } else {
            \Database::update('participations', $participation, array('participation_id' => $participationId));
        }

        $participation['participation_id'] = $participationId;

        if (is_array($entries)) {
            self::updateEntries($participationId, $entries);
        }


        return $participation;
    }

    public static function updateEntries($participationId, $entries)
    {
        global $odb;

        foreach ($entries as &$entry) {
            $entry['participation_id'] = $participationId;


            if (!empty($entry['entry_id'])) {
                $statement = $odb->prepare("
                      UPDATE participation_entries SET
                            participation_id = :participation_id,
                            station_id = :station_id,
                            participant_name = :participant_name,
                            time = :time,
                            time_start = :time_start,
                            time_finish = :time_finish,
                            hits = :hits
                      WHERE entry_id = :entry_id
                ");
                $statement->bindParam(":entry_id", $entry['entry_id']);
                $statement->bindParam(":participation_id", $entry['participation_id']);
                $statement->bindParam(":station_id", $entry['station_id']);
                $statement->bindParam(":participant_name", $entry['participant_name']);
                $statement->bindParam(":time", $entry['time']);
                $statement->bindParam(":time_start", $entry['time_start']);
                $statement->bindParam(":time_finish", $entry['time_finish']);
                $statement->bindParam(":hits", $entry['hits']);
                $statement->execute();
            } else {
                $statement = $odb->prepare("
                  INSERT INTO participation_entries
                    (participation_id, station_id, participant_name, time, time_start, time_finish, hits) VALUES
                    (:participation_id, :station_id, :participant_name, :time, :time_start, :time_finish, :hits)");
                $statement->bindParam(":participation_id", $entry['participation_id']);
                $statement->bindParam(":station_id", $entry['station_id']);
                $statement->bindParam(":participant_name", $entry['participant_name']);
                $statement->bindParam(":time", $entry['time']);
                $statement->bindParam(":time_start", $entry['time_start']);
                $statement->bindParam(":time_finish", $entry['time_finish']);
                $statement->bindParam(":hits", $entry['hits']);
                $statement->execute();

                $entry['entry_id'] = $odb->lastInsertId();
            }
        }
        unset($entry);
    }

    public static function getEntries($participationId)
    {
        global $odb;

        $statement = $odb->prepare("
            SELECT
              pe.*,
              cs.*
            FROM participation_entries AS pe
            LEFT JOIN participations AS p ON p.participation_id = pe.participation_id
            RIGHT JOIN challenge_stations AS cs ON cs.category_challenge_id = p.category_challenge_id AND cs.station_id = pe.station_id
            WHERE pe.participation_id = :participation_id
            GROUP BY pe.entry_id
			ORDER BY cs.station_type ASC, cs.station_id ASC
            /*ORDER BY pe.entry_id ASC*/
            ");
        $statement->bindParam(':participation_id', $participationId);
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);


        Station::setLabels($items);

        return $items;
    }

    public static function delete($participationId)
    {
        Database::delete('participation_entries', array('participation_id' => $participationId));
        Database::delete('participations', array('participation_id' => $participationId));
    }


} 