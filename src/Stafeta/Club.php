<?php

namespace Stafeta;

use PDO;
use PDOException;

class Club {
    public static function get($clubId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT * FROM clubs WHERE club_id = :club_id");
        $statement->bindParam(":club_id", $clubId);
        $statement->execute();
        $item = $statement->fetch(PDO::FETCH_ASSOC);

        return $item;
    }
} 