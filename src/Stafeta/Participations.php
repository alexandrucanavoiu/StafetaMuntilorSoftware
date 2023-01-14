<?php

namespace Stafeta;

use PDO;

class Participations {

    public static function getByTeamId($teamId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT * FROM participations WHERE team_id = :team_id");
        $statement->bindParam(":team_id", $teamId);
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $items;
    }

    public static function deleteByTeamId($teamId)
    {
        global $odb;

        $participations = self::getByTeamId($teamId);

        foreach ($participations as $participation) {
            Participation::delete($participation['participation_id']);
        }

        return true;
    }

} 