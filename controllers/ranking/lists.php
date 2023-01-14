<?php

use Stafeta\Category;

$categoryId = !empty($_REQUEST['category_id']) ? $_REQUEST['category_id'] : 0;

$category = Category::get($categoryId);

$number = 1;

		$sql = "
			SELECT teams.team_id, teams.team_name, categories.category_name,
			knowledge.answers, knowledge.time, knowledge.abandon, knowledge.scor
			FROM teams 
			INNER JOIN categories ON categories.category_id = teams.category_id
			LEFT JOIN knowledge ON knowledge.team_id = teams.team_id
			WHERE teams.category_id = :category_id
			ORDER BY knowledge.scor DESC, knowledge.time ASC
			";
			$knowledge = $odb->prepare($sql);
			$knowledge->bindValue(":category_id", $categoryId);
			$knowledge->execute();
			$lists = $knowledge->fetchAll(PDO::FETCH_ASSOC);

	

$number1 = 1;
			$sql2 = "
			SELECT teams.team_id, teams.team_name, categories.category_name,
			orienteering.name_participant, orienteering.start, orienteering.finish, 
			orienteering.total, orienteering.abandon, orienteering.missed_posts
			FROM teams 
			INNER JOIN categories ON categories.category_id = teams.category_id
			LEFT JOIN orienteering ON orienteering.team_id = teams.team_id
			WHERE teams.category_id = :category_id
			ORDER BY orienteering.total DESC 
			";
			$orienteeringselect = $odb->prepare($sql2);
			$orienteeringselect->bindValue(":category_id", $categoryId);
			$orienteeringselect->execute();
			$orienteering = $orienteeringselect->fetchAll(PDO::FETCH_ASSOC);	
		
		
$smarty->assign('number', $number);
$smarty->assign('number1', $number);
$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
$smarty->assign('totalteams', $lists);
$smarty->assign('orienteering', $orienteering);
