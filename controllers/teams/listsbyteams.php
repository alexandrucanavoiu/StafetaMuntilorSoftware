<?php
use Stafeta\Categories;
global $odb, $smarty;


$teamslists = $odb->prepare("
								SELECT
								  clubs.club_id
								  , clubs.club_name
								  , teams.club_id
								  , COUNT(teams.team_name) as echipe
								  , SUM(teams.category_id = 1) AS family
								  , SUM(teams.category_id = 2) AS juniori
								  , SUM(teams.category_id = 3) AS elite
								  , SUM(teams.category_id = 4) AS open
								  , SUM(teams.category_id = 5) AS veterani
								  , SUM(teams.category_id = 6) AS feminin
								FROM clubs JOIN teams
								  ON clubs.club_id = teams.club_id
								GROUP BY
								  clubs.club_id
								  , clubs.club_name
								  , teams.club_id
								ORDER BY echipe DESC;
			");
			


$teamslists->execute();
$lists = $teamslists->fetchAll();

//echo "<pre>";
//var_dump ( $lists );
//echo "</pre>";

$number = 1;

$smarty->assign('totalteams', $lists);
$smarty->assign('number', $number);
