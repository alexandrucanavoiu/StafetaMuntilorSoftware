<?php
use Stafeta\Category;
use Stafeta\Ranking;

$categoryId = !empty($_REQUEST['category_id']) ? $_REQUEST['category_id'] : 0;
$category = Category::get($categoryId);

$items = Ranking::generalCategorySetup($categoryId);
$number = 1;

$smarty->assign('items', $items);
$smarty->assign('number', $number);

$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
