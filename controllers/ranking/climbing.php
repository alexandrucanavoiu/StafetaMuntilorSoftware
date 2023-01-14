<?php

use Stafeta\Category;
use Stafeta\Ranking;

	$categoryId = !empty($_REQUEST['category_id']) ? $_REQUEST['category_id'] : 0;
	$category = Category::get($categoryId);


	$sql = "
		SELECT
			teams.team_id,
			teams.team_name,
			categories.category_name,
			climbing.name_participant,
			climbing.timp,
			TIME_TO_SEC(climbing.timp) as seconds,
			climbing.abandon,
			climbing.top
		FROM teams
		INNER JOIN categories ON categories.category_id = teams.category_id
		LEFT JOIN climbing ON climbing.team_id = teams.team_id
		WHERE teams.category_id = :category_id
		ORDER BY climbing.abandon ASC, climbing.top DESC, climbing.timp ASC
	";
	
	$climbing = $odb->prepare($sql);
	$climbing->bindValue(":category_id", $categoryId);
	$climbing->execute();
	$lists = $climbing->fetchAll(PDO::FETCH_ASSOC);

	$lists = Ranking::rank($lists, array('seconds', 'top'));

$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
$smarty->assign('lists', $lists);