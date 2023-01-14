<?php
use Stafeta\Category;


$id_organizer = $_REQUEST['id_organizer'];

if ( isset($_POST['name_organizer']) ) {
	// 1. check if a records already exists for this $id_organizer
	//  if exists, UPDATE it based on the knowledge_id of that records
	//  else INSERT a new record for that id_organizer
	
		$id_organizer = $_REQUEST['id_organizer'];
		$name_trophy = $_REQUEST['name_trophy'];
		$name_organizer = $_REQUEST['name_organizer'];
		$phase_trophy = $_REQUEST['phase_trophy'];
		
		$sql = "SELECT *
				FROM organizer
				WHERE id_organizer = :id_organizer";
		$statement = $odb->prepare($sql);
		$statement->bindValue(":id_organizer", $id_organizer);
		$statement->execute();

		if( $statement->rowCount() > 0 ) {

		$id_organizer = $_REQUEST['id_organizer'];
		$name_trophy = $_REQUEST['name_trophy'];
		$name_organizer = $_REQUEST['name_organizer'];
		$phase_trophy = $_REQUEST['phase_trophy'];
		
				 $sql  = "UPDATE `organizer` SET `name_trophy` = :name_trophy, `name_organizer` = :name_organizer, `phase_trophy` = :phase_trophy WHERE `id_organizer` = :id_organizer";
				 $update = $odb->prepare($sql);
				 $update->bindValue(":name_trophy", $name_trophy);
				 $update->bindValue(":name_organizer", $name_organizer);
				 $update->bindValue(":phase_trophy", $phase_trophy);
				 $update->bindValue(":id_organizer", $id_organizer);
				     if ($update->execute()) {
						addSuccess("Modificările au fost salvate");
					} else {
						addError("Modificările nu au fost salvate");
					}

					redirect('challenges/configure');
				 
		}
		else {
			 $insert = $odb->prepare("INSERT INTO `organizer` (`name_trophy`, `name_organizer`, `phase_trophy`) VALUES (:name_trophy, :name_organizer, :phase_trophy)");
			$insert->bindValue(":name_trophy", $name_trophy);
			$insert->bindValue(":name_organizer", $name_organizer);
			$insert->bindValue(":phase_trophy", $phase_trophy);
			$insert->execute();

		}

}

		$sql = "SELECT *
				FROM organizer
				WHERE id_organizer = :id_organizer";
		$statement = $odb->prepare($sql);
		$statement->bindValue(":id_organizer", $id_organizer);
		$statement->execute();
		$knowledge = $statement->fetch();


$smarty->assign('category', $category);
$smarty->assign('category_id', $categoryId);
$smarty->assign('organizator', $organizator);
$smarty->assign('update', $update);
$smarty->assign('knowledge', $knowledge);
