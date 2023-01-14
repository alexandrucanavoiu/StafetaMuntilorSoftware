<?php
use Stafeta\Category;

$categoryId = !empty($_REQUEST['category_id']) ? $_REQUEST['category_id'] : 0;
$team_id = !empty($_REQUEST['team_id']) ? $_REQUEST['team_id'] : 0;

$category = Category::get($categoryId);

$sql = "
	SELECT teams.team_id, teams.team_name, categories.category_name, clubs.club_name
	FROM teams 
	INNER JOIN categories ON categories.category_id = teams.category_id
	LEFT JOIN clubs ON clubs.club_id = teams.club_id
	WHERE teams.category_id = :category_id AND teams.team_id = :team_id
	";
$statement = $odb->prepare($sql);
$statement->bindValue(":category_id", $categoryId);
$statement->bindValue(":team_id", $team_id);
$statement->execute();
$team = $statement->fetch();




if ( isset($_POST['answers']) ) {
	// 1. check if a records already exists for this $team_id
	//  if exists, UPDATE it based on the knowledge_id of that records
	//  else INSERT a new record for that team_id
	
		$team_id = $_REQUEST['team_id'];
		$answers = $_REQUEST['answers'];
		$time = $_REQUEST['time'];
		$answers = $_REQUEST['answers'];
		$wrongquestions = $_REQUEST['wrongquestions'];
		$abandon = $_REQUEST['abandon'];
		
		$sql = "SELECT *
				FROM knowledge
				WHERE team_id = :team_id";
		$statement = $odb->prepare($sql);
		$statement->bindValue(":team_id", $team_id);
		$statement->execute();

		if( $statement->rowCount() > 0 ) {
				if ( $abandon == 0 ) {
				 $scor2 = $answers * 20;
				 $scor = 300 - $scor2;
				 } else {
					 $scor = 0;
				 }
				 $sql  = "UPDATE `knowledge` SET `answers` = :answers, `time` = :time, `scor` = :scor, `abandon` = :abandon, `wrongquestions` = :wrongquestions  WHERE `team_id` = :team_id LIMIT 1";
				 $update = $odb->prepare($sql);
				 $update->bindValue(":team_id", $team_id);
				 $update->bindValue(":answers", $answers);
				 $update->bindValue(":time", $time);
				 $update->bindValue(":abandon", $abandon);
				 $update->bindValue(":wrongquestions", $wrongquestions);
				 $update->bindValue(":scor", $scor);
				     if ($update->execute()) {
							addSuccess("Modificările au fost salvate");
						} else {
							addError("Modificările nu au fost salvate");
						}

						redirect('knowledge/lists', array('category_id' => $categoryId ));
		}
		else {
				if ( $abandon == 0 ) {
				 $scor2 = $answers * 20;
				 $scor = 300 - $scor2;
				 } else {
					 $scor = 0;
				 }
			 $insert = $odb->prepare("INSERT INTO `knowledge` (`team_id`, `answers`, `time`, `abandon`, `wrongquestions`, `scor`) VALUES (:team_id, :answers, :time, :abandon, :wrongquestions, :scor)");
			$insert->bindValue(":team_id", $team_id);
			$insert->bindValue(":answers", $answers);
			$insert->bindValue(":time", $time);
			$insert->bindValue(":abandon", $abandon);
			$insert->bindValue(":wrongquestions", $wrongquestions);
			$insert->bindValue(":scor", $scor);			
				     if ($insert->execute()) {
							addSuccess("Modificările au fost salvate");
						} else {
							addError("Modificările nu au fost salvate");
						}

						redirect('knowledge/lists', array('category_id' => $categoryId ));
		}

}

		$sql = "SELECT *
				FROM knowledge
				WHERE team_id = :team_id";
		$statement = $odb->prepare($sql);
		$statement->bindValue(":team_id", $team_id);
		$statement->execute();
		$knowledge = $statement->fetch();



$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
$smarty->assign('team', $team);
$smarty->assign('update', $update);
$smarty->assign('knowledge', $knowledge);
