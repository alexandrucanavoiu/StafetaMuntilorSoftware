<?php

namespace Stafeta;

use PDO;

class Categories {
    public static function get($sort = false)
    {
        global $odb;

        $statement = $odb->query("SELECT * FROM categories " . ($sort == true ? 'ORDER BY position ASC' : ''));
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }
} 