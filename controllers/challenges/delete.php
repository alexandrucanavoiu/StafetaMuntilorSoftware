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
use Stafeta\Station;

global $odb, $smarty;

$categoryId = !empty($_REQUEST['category_id']) ? $_REQUEST['category_id'] : 0;
$challengeId = !empty($_REQUEST['challenge_id']) ? $_REQUEST['challenge_id'] : 0;

CategoryChallenge::deleteByIds($categoryId, $challengeId);
header('Location: /stafeta/?page=challenges/update&category_id=' . $categoryId . '&challenge_id=' . $challengeId);