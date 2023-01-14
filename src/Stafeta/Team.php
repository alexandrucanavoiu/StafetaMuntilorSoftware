<?php

namespace Stafeta;

use Database;
use PDO;
use PDOException;

class Team {
    public static function get($teamId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT * FROM teams WHERE team_id = :team_id");
        $statement->bindParam(":team_id", $teamId);
        $statement->execute();
        $item = $statement->fetch(PDO::FETCH_ASSOC);

        $item['club'] = empty($item['club_id']) ? array() : self::getClub($item['club_id']);

        return $item;
    }

    public static function getClub($clubId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT * FROM clubs WHERE club_id = :club_id");
        $statement->bindParam(":club_id", $clubId);
        $statement->execute();
        $item = $statement->fetch(PDO::FETCH_ASSOC);

        return $item;
    }

    public static function delete($teamId)
    {
        global $odb;

        Database::delete('knowledge', array('team_id' => $teamId));
        Database::delete('orienteering', array('team_id' => $teamId));
        Database::delete('climbing', array('team_id' => $teamId));
        Participations::deleteByTeamId($teamId);
        Database::delete('teams', array('team_id' => $teamId));
    }
} 