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




if ( isset($_POST['timp']) ) {
	// 1. check if a records already exists for this $team_id
	//  if exists, UPDATE it based on the knowledge_id of that records
	//  else INSERT a new record for that team_id
	
		$team_id = $_REQUEST['team_id'];
		$name_participant = $_REQUEST['name_participant'];
		$timp = $_REQUEST['timp'];
		$missed_nods = $_REQUEST['missed_nods'];
		$top = $_REQUEST['top'];
		$abandon = $_REQUEST['abandon'];
		
		$sql = "SELECT *
				FROM climbing
				WHERE team_id = :team_id";
		$statement = $odb->prepare($sql);
		$statement->bindValue(":team_id", $team_id);
		$statement->execute();

		if( $statement->rowCount() > 0 ) {
					
				 $sql  = "UPDATE `climbing` SET `name_participant` = :name_participant, `timp` = :timp, `missed_nods` = :missed_nods, `top` = :top, `abandon` = :abandon WHERE `team_id` = :team_id LIMIT 1";
				 $update = $odb->prepare($sql);
				 $update->bindValue(":name_participant", $name_participant);
				 $update->bindValue(":timp", $timp);
				 $update->bindValue(":missed_nods", $missed_nods);
				 $update->bindValue(":top", $top);
				 $update->bindValue(":abandon", $abandon);
				 $update->bindValue(":team_id", $team_id);
					if ($update->execute()) {
						addSuccess("Modificările au fost salvate");
					} else {
						addError("Modificările nu au fost salvate");
					}

					redirect('climbing/lists', array('category_id' => $categoryId ));
		}
		else {
			
			 $insert = $odb->prepare("INSERT INTO `climbing` (`team_id`, `name_participant`, `timp`, `missed_nods`, `top`, `abandon`) VALUES (:team_id, :name_participant, :timp, :missed_nods, :top, :abandon)");
				$insert->bindValue(":team_id", $team_id);
				 $insert->bindValue(":name_participant", $name_participant);
				 $insert->bindValue(":timp", $timp);
				 $insert->bindValue(":missed_nods", $missed_nods);
				 $insert->bindValue(":top", $top);
				 $insert->bindValue(":abandon", $abandon);
				     if ($insert->execute()) {
							addSuccess("Modificările au fost salvate");
						} else {
							addError("Modificările nu au fost salvate");
						}

						redirect('climbing/lists', array('category_id' => $categoryId ));
		}

}

		$sql = "SELECT *
				FROM climbing
				WHERE team_id = :team_id";
		$statement = $odb->prepare($sql);
		$statement->bindValue(":team_id", $team_id);
		$statement->execute();
		$climbing = $statement->fetch();



$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
$smarty->assign('team', $team);
$smarty->assign('update', $update);
$smarty->assign('climbing', $climbing);
