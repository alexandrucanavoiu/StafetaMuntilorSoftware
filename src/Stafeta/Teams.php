<?php

namespace Stafeta;

use PDO;
use PDOException;

class Teams {
    public static function get()
    {
        global $odb;

        $statement = $odb->query("SELECT * FROM teams");
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $items;
    }
    public static function getByIds($teamIds)
    {
        global $odb;

        if (empty($teamIds)) {
            return array();
        }
        $teamIds = implode(',', $teamIds);
        $statement = $odb->prepare("SELECT * FROM teams WHERE FIND_IN_SET(team_id, :team_id)");
        $statement->bindParam(":team_id", $teamIds);
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $items;
}
    public static function getByCategoryChallengeId($categoryChallengeId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT team_id FROM participations WHERE category_challenge_id = :category_challenge_id");
        $statement->bindParam(":category_challenge_id", $categoryChallengeId);
        $statement->execute();
        $teamIds = $statement->fetchAll(PDO::FETCH_COLUMN);

        return Teams::getByIds($teamIds);
    }
    public static function getByCategoryId($categoryId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT * FROM teams WHERE category_id = :category_id");
        $statement->bindParam(":category_id", $categoryId);
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $items;
    }

    public static function getByClubId($clubId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT * FROM teams WHERE club_id = :club_id");
        $statement->bindParam(":club_id", $clubId);
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $items;
    }

    public static function deleteByClub($clubId)
    {
        global $odb;

        $teams = Teams::getByClubId($clubId);
        foreach ($teams as $team) {
            Team::delete($team['team_id']);
        }

        return true;
    }
} 