<?php

namespace Stafeta;


use PDO;

class Challenges {
    public static function get()
    {
        global $odb;

        $statement = $odb->query("SELECT * FROM challenges");
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $items;
    }
} 