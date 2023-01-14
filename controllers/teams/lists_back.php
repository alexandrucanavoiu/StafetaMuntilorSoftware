<?php
use Stafeta\Categories;
global $odb, $smarty;

$teamslists = $odb->query("
			SELECT teams.team_id, clubs.club_name, teams.team_name, categories.category_name
			FROM teams 
			INNER JOIN clubs ON clubs.club_id = teams.club_id
			INNER JOIN categories ON categories.category_id = teams.category_id
			ORDER BY teams.club_id
			");
$teamslists->execute();
$lists = $teamslists->fetchAll();




$smarty->assign('totalteams', $lists);
