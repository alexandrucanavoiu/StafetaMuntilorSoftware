<?php

use Stafeta\Category;
use Stafeta\CategoryChallenge;
use Stafeta\Challenge;
use Stafeta\Ranking;
use Stafeta\Teams;

global $smarty;

$categoryId = !empty($_REQUEST['category_id']) ? $_REQUEST['category_id'] : 0;

$challengeId = 1; // El Raid
$challenge = Challenge::get($challengeId);
$category = Category::get($categoryId);
$categoryChallenge = CategoryChallenge::getByIds($categoryId, $challengeId);
$categoryChallengeId = $categoryChallenge['category_challenge_id'];

$teams = Teams::getByCategoryChallengeId($categoryChallengeId);

$ranks = Ranking::raidAll($categoryId, $teams);

//$number = 1;
//
//$teamId = !empty($_REQUEST['team_id']) ? $_REQUEST['team_id'] : 88;
//$teamId = 146;
//
//Ranking::raid($teamId);

$smarty->assign('ranks', $ranks);
$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
$smarty->assign('challenge', $challenge);
$smarty->assign('organizer', $organizer);
$smarty->assign('categoryChallenge', $categoryChallenge);
$smarty->assign('categoryChallengeId', $categoryChallengeId);