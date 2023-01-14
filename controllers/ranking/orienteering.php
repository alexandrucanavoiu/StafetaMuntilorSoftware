<?php

use Stafeta\Category;
use Stafeta\Ranking;

global $smarty;

$categoryId = !empty($_REQUEST['category_id']) ? $_REQUEST['category_id'] : 0;

$category = Category::get($categoryId);

$number = 1;

$teams = Ranking::orienteering($categoryId);
$teams = Ranking::rank($teams, 'score');

//aa($teams,1);

$smarty->assign('number', $number);
$smarty->assign('ranking', $teams);
$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
