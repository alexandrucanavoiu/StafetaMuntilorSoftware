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


$challenge = Challenge::get($challengeId);
$category = Category::get($categoryId);

$categoryChallenge = CategoryChallenge::getByIds($categoryId, $challengeId);
$update = empty($_REQUEST['category_challenge']) ? array() : $_REQUEST['category_challenge'];
if (empty($categoryChallenge)) {
    $categoryChallenge = array(
        'category_id' => $categoryId,
        'challenge_id' => $challengeId,
    );
	$stations = array();
} else {
	$stations = CategoryChallenge::getStations($categoryChallenge['category_challenge_id']);
}


if ($_POST) {

    $categoryChallenge = array_merge($categoryChallenge, $update);

	$categoryChallengeId = CategoryChallenge::update($categoryChallenge);
	
	$data = array();
	$nextIds = array();
	foreach ($_POST['station_type'] as $index => $station_type) {
		$data[$index] = array();
		$data[$index]['station_id'] = $_POST['station_id'][$index];
		$data[$index]['station_type'] = $_POST['station_type'][$index];
		$data[$index]['category_challenge_id'] = $categoryChallengeId;
		$data[$index]['maximum_time'] = null;
		$data[$index]['score'] = null;
		if (in_array($data[$index]['station_type'], array(Station::TYPE_PA, Station::TYPE_FINISH))) {
			$data[$index]['maximum_time'] = $_POST['value'][$index];
		}
		if ($data[$index]['station_type'] == Station::TYPE_PFA) {
			$data[$index]['score'] = $_POST['value'][$index];
		}
		if (!empty($data[$index]['station_id'])) {
			$nextIds[] = $data[$index]['station_id'];
		}
	}
	

	$prevIds = array();
	foreach ($stations as $station) {
		$prevIds[] = $station['station_id'];
	}
	
	$deletedIds = array_diff($prevIds, $nextIds);

	CategoryChallenge::deleteStationsByIds($deletedIds);

	CategoryChallenge::updateStations($categoryChallengeId, $data);

	
	header('Location: /stafeta/?page=challenges/update&category_id=' . $categoryId . '&challenge_id=' . $challengeId);
	
	exit;
}



$smarty->assign('station_types', Station::getTypes());

$smarty->assign('category_id', $categoryId);
$smarty->assign('challenge_id', $challengeId);
$smarty->assign('category', $category);
$smarty->assign('challenge', $challenge);
$smarty->assign('categoryChallenge', $categoryChallenge);
$smarty->assign('stations', $stations);