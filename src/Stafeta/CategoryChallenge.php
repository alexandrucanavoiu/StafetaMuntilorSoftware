<?php

namespace Stafeta;


use PDO;

class CategoryChallenge {



    public function __construct($categoryId, $challengeId)
    {

    }

    public static function deleteStationsByIds($ids)
	{
		global $odb;
		$statement = $odb->prepare("DELETE FROM challenge_stations WHERE FIND_IN_SET(station_id, :ids)");
		$statement->bindParam(":ids", implode(',', $ids));
		$statement->execute();
	}

    public static function getStations($categoryChallengeId)
	{
        global $odb;

        $statement = $odb->prepare("SELECT * FROM challenge_stations WHERE category_challenge_id = :category_challenge_id ORDER BY station_type ASC, station_id ASC");
        $statement->bindParam(":category_challenge_id", $categoryChallengeId);
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        Station::setLabels($items);

        return $items;
	}
    public static function deleteStations($categoryChallengeId)
	{
		global $odb;
		$statement = $odb->prepare("DELETE FROM challenge_stations WHERE category_challenge_id = :category_challenge_id");
		$statement->bindParam(":category_challenge_id", $categoryChallengeId);
		$statement->execute();
	}
    public static function updateStations($categoryChallengeId, $data)
	{
		global $odb;
		
		// self::deleteStations($categoryChallengeId);
		
		foreach ($data as $i => $station) {
			if (!empty($station['station_id'])) {
				$statement = $odb->prepare("UPDATE challenge_stations SET station_type = :station_type, maximum_time = :maximum_time, score = :score WHERE station_id = :station_id");
				$statement->bindParam(":station_type", $station['station_type']);
				$statement->bindParam(":score", $station['score']);
				$statement->bindParam(":station_id", $station['station_id']);
				$statement->bindParam(":maximum_time", $station['maximum_time']);
				$statement->execute();
			} else {				
				$statement = $odb->prepare("INSERT INTO challenge_stations (category_challenge_id, station_type, maximum_time, score) VALUES (:category_challenge_id, :station_type, :maximum_time, :score)");
				$statement->bindParam(":category_challenge_id", $categoryChallengeId);
				$statement->bindParam(":station_type", $station['station_type']);
				$statement->bindParam(":maximum_time", $station['maximum_time']);
				$statement->bindParam(":score", $station['score']);
				$statement->execute();
				$stationId = $data[$i]['station_id'] = $odb->lastInsertId(); 
			}
		}		
	}
    public static function update($categoryChallenge)
	{
		$categoryChallengeId = empty($categoryChallenge['category_challenge_id']) ? 0 : intval($categoryChallenge['category_challenge_id']);
		if (empty($categoryChallengeId)) {
            $categoryChallengeId = \Database::insert('category_challenges', $categoryChallenge);
        } else {
            \Database::update('category_challenges', $categoryChallenge, array('category_challenge_id' => $categoryChallengeId));
        }
		
		return $categoryChallengeId;
	}
    public static function getByIds($categoryId, $challengeId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT * FROM category_challenges WHERE category_id = :category_id AND challenge_id = :challenge_id");
        $statement->bindParam(":category_id", $categoryId);
        $statement->bindParam(":challenge_id", $challengeId);
        $statement->execute();
        $item = $statement->fetch(PDO::FETCH_ASSOC);

        return $item;
    }

    public static function getById($categoryChallengeId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT * FROM category_challenges WHERE category_challenge_id = :category_challenge_id");
        $statement->bindParam(":category_challenge_id", $categoryChallengeId);
        $statement->execute();
        $item = $statement->fetch(PDO::FETCH_ASSOC);

        return $item;
    }

    public static function delete($categoryChallengeId)
    {
        global $odb;

        $statement = $odb->prepare("DELETE FROM category_challenges WHERE category_challenge_id = :category_challenge_id");
        $statement->bindParam(":category_challenge_id", $categoryChallengeId);
        $statement->execute();



        return true;
    }
} 