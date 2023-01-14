<?php


global $odb, $smarty;

// Afisare lista
$clubslists = $odb->query("
			SELECT *
			FROM clubs
			ORDER BY scor_cultural DESC
			");
$clubslists->execute();
$lists = $clubslists->fetchAll();

// Generare PDF
$genlists = $odb->query("
				SELECT *
				FROM `clubs`
				WHERE `scor_cultural` >=1
				ORDER BY scor_cultural DESC
				LIMIT 0 , 30
			");
$genlists->execute();
$gencultural = $genlists->fetchAll();


$number = 1;

$smarty->assign('totalclubs', $lists);
$smarty->assign('gencultural', $gencultural);
$smarty->assign('number', $number);
