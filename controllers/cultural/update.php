<?php
use Stafeta\Category;

$club_id = !empty($_REQUEST['club_id']) ? $_REQUEST['club_id'] : 0;


$sql = "
	SELECT *
	FROM clubs
	WHERE clubs.club_id = :club_id
	";
$statement = $odb->prepare($sql);
$statement->bindValue(":club_id", $club_id);
$statement->execute();
$team = $statement->fetch();




if ( isset($_POST['scor_cultural']) ) {
	// 1. check if a records already exists for this $club_id
	//  if exists, UPDATE it based on the knowledge_id of that records
	//  else INSERT a new record for that club_id
	
		$club_id = $_REQUEST['club_id'];
		$scor_cultural = $_REQUEST['scor_cultural'];
		
		$sql = "SELECT *
				FROM clubs
				WHERE club_id = :club_id";
		$statement = $odb->prepare($sql);
		$statement->bindValue(":club_id", $club_id);
		$statement->execute();

		if( $statement->rowCount() > 0 ) {
				 $sql  = "UPDATE `clubs` SET `scor_cultural` = :scor_cultural WHERE `club_id` = :club_id LIMIT 1";
				 $update = $odb->prepare($sql);
				 $update->bindValue(":club_id", $club_id);
				 $update->bindValue(":scor_cultural", $scor_cultural);
					if ($update->execute()) {
						addSuccess("Modificările au fost salvate");
					} else {
						addError("Modificările nu au fost salvate");
					}

					redirect('cultural/lists');
		}
	
		else {
			 $insert = $odb->prepare("INSERT INTO `clubs` (scor_cultural) VALUES (:scor_cultural) WHERE `club_id` = :club_id");
			$insert->bindValue(":club_id", $club_id);
			$insert->bindValue(":scor_cultural", $scor_cultural);
					if ($update->execute()) {
						addSuccess("Modificările au fost salvate");
					} else {
						addError("Modificările nu au fost salvate");
					}

					redirect('cultural/lists');
		}

}

		$sql = "SELECT *
				FROM clubs
				WHERE club_id = :club_id";
		$statement = $odb->prepare($sql);
		$statement->bindValue(":club_id", $club_id);
		$statement->execute();
		$club = $statement->fetch();



$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
$smarty->assign('team', $team);
$smarty->assign('update', $update);
$smarty->assign('club', $club);
