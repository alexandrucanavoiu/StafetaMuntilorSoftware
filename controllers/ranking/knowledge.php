<?php

use Stafeta\Category;

$categoryId = !empty($_REQUEST['category_id']) ? $_REQUEST['category_id'] : 0;

$category = Category::get($categoryId);

$number = 1;

	$sql = "
		SELECT teams.team_id, teams.team_name, categories.category_name,
		knowledge.answers, knowledge.time, knowledge.abandon, knowledge.scor, knowledge.wrongquestions
		FROM teams
		INNER JOIN categories ON categories.category_id = teams.category_id
		LEFT JOIN knowledge ON knowledge.team_id = teams.team_id
		WHERE teams.category_id = :category_id
		ORDER BY knowledge.scor DESC, knowledge.time ASC
		";
	$knowledge = $odb->prepare($sql);
	$knowledge->bindValue(":category_id", $categoryId);
	$knowledge->execute();
	$items = $knowledge->fetchAll(PDO::FETCH_ASSOC);


	$sql2 = "SELECT *
			FROM organizer
			WHERE id_organizer = 1";
	$statement = $odb->prepare($sql2);
	$statement->execute();
	$organizer = $statement->fetchAll(PDO::FETCH_ASSOC);

	foreach ($items as $i => $item) {
		$items[$i]['time_seconds'] = stringToSeconds($item['time']);
	}
	
	$items   = \Stafeta\Ranking::rank($items, array('scor', 'time_seconds'));


$smarty->assign('number', $number);
$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
$smarty->assign('lists', $items);
$smarty->assign('organizer', $organizer);