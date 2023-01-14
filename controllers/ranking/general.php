<?php

global $smarty;


use Stafeta\Categories;
use Stafeta\Ranking;

	try {
		$ranking = Ranking::general();
	} catch (Exception $e) {
		$ranking = array();
		addError("Eroare la generarea clasamentului: " . $e->getMessage());
	}
	
$smarty->assign('ranking', $ranking);

$categories = Categories::get(true);
$smarty->assign('categories', $categories);
