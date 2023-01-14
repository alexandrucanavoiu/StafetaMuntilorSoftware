<?php

use Stafeta\Category;


global $odb, $smarty;

$categoryId = !empty($_REQUEST['category_id']) ? $_REQUEST['category_id'] : 0;

$category = Category::get($categoryId);

		$sql = "
			SELECT teams.team_id, teams.team_name, categories.category_name,
				climbing.name_participant,
				climbing.missed_nods,
				climbing.timp,
				climbing.abandon,
				climbing.top
			FROM teams 
			INNER JOIN categories ON categories.category_id = teams.category_id
			LEFT JOIN climbing ON climbing.team_id = teams.team_id
			WHERE teams.category_id = :category_id
			Order by teams.team_name ASC
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
