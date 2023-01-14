<?php

namespace Stafeta;

use PDO;

class Category {
    public static function get($categoryId)
    {
        global $odb;

        $statement = $odb->prepare("SELECT * FROM categories WHERE category_id = :category_id");
        $statement->bindParam(":category_id", $categoryId);
        $statement->execute();
        $item = $statement->fetch(PDO::FETCH_ASSOC);

        return $item;
    }
} 