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




if ( isset($_POST['start']) ) {
	// 1. check if a records already exists for this $team_id
	//  if exists, UPDATE it based on the knowledge_id of that records
	//  else INSERT a new record for that team_id
	
		$team_id = $_REQUEST['team_id'];
		$name_participant = $_REQUEST['name_participant'];
		$start = $_REQUEST['start'];
		$finish = $_REQUEST['finish'];
		$total = $_REQUEST['total'];
		$missed_posts = $_REQUEST['missed_posts'];
		$abandon = $_REQUEST['abandon'];
		
		$sql = "SELECT *
				FROM orienteering
				WHERE team_id = :team_id";
		$statement = $odb->prepare($sql);
		$statement->bindValue(":team_id", $team_id);
		$statement->execute();

		if( $statement->rowCount() > 0 ) {
			
			   $strStart = $start;
			   $strEnd   = $finish;
			   $dteStart = new DateTime($strStart);
			   $dteEnd   = new DateTime($strEnd);
			   $dteDiff  = $dteStart->diff($dteEnd);
			   $total = $dteDiff->format("%H:%I:%S");
			
			
				 $sql  = "UPDATE `orienteering` SET `name_participant` = :name_participant, `start` = :start, `finish` = :finish, `total` = :total, `missed_posts` = :missed_posts, `abandon` = :abandon WHERE `team_id` = :team_id LIMIT 1";
				 $update = $odb->prepare($sql);
				 $update->bindValue(":name_participant", $name_participant);
				 $update->bindValue(":start", $start);
				 $update->bindValue(":finish", $finish);
				 $update->bindValue(":total", $total);
				 $update->bindValue(":missed_posts", $missed_posts);
				 $update->bindValue(":abandon", $abandon);
				 $update->bindValue(":team_id", $team_id);
				     if ($update->execute()) {
							addSuccess("Modificările au fost salvate");
						} else {
							addError("Modificările nu au fost salvate");
						}

						redirect('orienteering/lists', array('category_id' => $categoryId ));
		}
		else {
			
			   $strStart = $start;
			   $strEnd   = $finish;
			   $dteStart = new DateTime($strStart);
			   $dteEnd   = new DateTime($strEnd);
			   $dteDiff  = $dteStart->diff($dteEnd);
			   $total = $dteDiff->format("%H:%I:%S");
			
			 $insert = $odb->prepare("INSERT INTO `orienteering` (`team_id`, `name_participant`, `start`, `finish`, `total`, `missed_posts`, `abandon`) VALUES (:team_id, :name_participant, :start, :finish, :total, :missed_posts, :abandon)");
				$insert->bindValue(":team_id", $team_id);
				$insert->bindValue(":name_participant", $name_participant);
				 $insert->bindValue(":start", $start);
				 $insert->bindValue(":finish", $finish);
				 $insert->bindValue(":total", $total);
				 $insert->bindValue(":missed_posts", $missed_posts);
				 $insert->bindValue(":abandon", $abandon);
				     if ($insert->execute()) {
							addSuccess("Modificările au fost salvate");
						} else {
							addError("Modificările nu au fost salvate");
						}

						redirect('orienteering/lists', array('category_id' => $categoryId ));
		}

}

		$sql = "SELECT *
				FROM orienteering
				WHERE team_id = :team_id";
		$statement = $odb->prepare($sql);
		$statement->bindValue(":team_id", $team_id);
		$statement->execute();
		$orienteering = $statement->fetch();



$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
$smarty->assign('team', $team);
$smarty->assign('update', $update);
$smarty->assign('orienteering', $orienteering);
