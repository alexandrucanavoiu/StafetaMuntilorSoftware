<?php

use Stafeta\Category;

$categoryId = !empty($_REQUEST['category_id']) ? $_REQUEST['category_id'] : 0;

$category = Category::get($categoryId);

		$sql = "
			SELECT teams.team_id, teams.team_name, categories.category_name,
			knowledge.answers, knowledge.time, knowledge.abandon, knowledge.wrongquestions
			FROM teams 
			INNER JOIN categories ON categories.category_id = teams.category_id
			LEFT JOIN knowledge ON knowledge.team_id = teams.team_id
			WHERE teams.category_id = :category_id
			";
			$teamslists = $odb->prepare($sql);
			$teamslists->bindValue(":category_id", $categoryId);
			$teamslists->execute();
			$lists = $teamslists->fetchAll(PDO::FETCH_ASSOC);

$number = 1;
$smarty->assign('number', $number);
$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
$smarty->assign('totalteams', $lists);