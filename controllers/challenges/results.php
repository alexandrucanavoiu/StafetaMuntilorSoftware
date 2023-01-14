<?php
/**
 * Created by PhpStorm.
 * User: WSergio
 * Date: 20/06/2015
 * Time: 17:42:37 PM
 */
use Stafeta\Category;
use Stafeta\CategoryChallenge;
use Stafeta\Challenge;
use Stafeta\Teams;

global $odb, $smarty;

$categoryId = !empty($_REQUEST['category_id']) ? $_REQUEST['category_id'] : 0;
$challengeId = !empty($_REQUEST['challenge_id']) ? $_REQUEST['challenge_id'] : 0;

$challenge = Challenge::get($challengeId);
$category = Category::get($categoryId);

$smarty->assign('category_id', $categoryId);
$smarty->assign('challenge_id', $challengeId);
$smarty->assign('category', $category);
$smarty->assign('challenge', $challenge);


$teams = Teams::getByCategoryId($categoryId);

$smarty->assign('entries', $teams);



$categoryChallenge = CategoryChallenge::getByIds($categoryId, $challengeId);
$smarty->assign('categoryChallenge', $categoryChallenge);
