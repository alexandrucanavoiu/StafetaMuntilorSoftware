<?php
	use Stafeta\Categories;
	global $odb, $smarty;

$condition = '';
		if (!empty($_REQUEST['category_id'])) {
			$condition = 'WHERE categories.category_id = :category_id';
		}

$teamslists = $odb->prepare("
			SELECT teams.team_id, clubs.club_name, teams.team_name, categories.category_name
			FROM teams 
			INNER JOIN clubs ON clubs.club_id = teams.club_id
			INNER JOIN categories ON categories.category_id = teams.category_id
			$condition
			ORDER BY clubs.club_name ASC
			");

		if (!empty($_REQUEST['category_id'])) {
			$teamslists->bindParam(":category_id", $_REQUEST['category_id']);
		}
		
$teamslists->execute();
$lists = $teamslists->fetchAll();

$categorie = $_REQUEST['category_id'];

$number = 1;

$smarty->assign('totalteams', $lists);
$smarty->assign('categorie', $categorie);
$smarty->assign('number', $number);
