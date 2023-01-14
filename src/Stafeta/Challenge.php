<?php
namespace Stafeta;


use PDO;

class Challenge {


    public static function get($challengeId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT * FROM challenges WHERE challenge_id = :challenge_id");
        $statement->bindParam(":challenge_id", $challengeId);
        $statement->execute();
        $item = $statement->fetch(PDO::FETCH_ASSOC);

        return $item;
    }
} 