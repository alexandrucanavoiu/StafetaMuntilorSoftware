<?php
use Stafeta\Categories;

global $odb, $smarty;

	if(isset($_POST['team_name'])) {
		$team_name = $_REQUEST['team_name'];
		$club_id    = $_REQUEST['club_id'];
		$category_id   = $_REQUEST['category_id'];
		$team_id = $_REQUEST['team_id'];
		$sql  = "UPDATE `teams` SET `team_name` = :team_name, `club_id` = :club_id, `category_id` = :category_id WHERE `team_id` = :team_id";
		 $update = $odb->prepare($sql);
		 $update->bindValue(":team_name", $team_name);
		 $update->bindValue(":club_id", $club_id);
		 $update->bindValue(":category_id", $category_id);
		 $update->bindValue(":team_id", $team_id);
				if ($update->execute()) {
					addSuccess("Modificările au fost salvate");
				} else {
					addError("Modificările nu au fost salvate");
				}

				redirect('teams/lists');
			
		}


$category_id = $_POST['category_id'];

	if (isset($_REQUEST['team_id']) && is_numeric($_REQUEST['team_id']))
	{
			 // get id value
				$team_id = $_REQUEST['team_id'];
			 
			$sql = $odb->query("SELECT * FROM teams WHERE team_id = $team_id ");
			$sql->execute();
				$row = $sql->fetch(PDO::FETCH_ASSOC);
				
			
		
	}
	
	$clubslists = $odb->query("SELECT * FROM clubs");
	$clubslists->execute();
	$lists = $clubslists->fetchAll();

	
	
	$categories = Categories::get();
	
	$smarty->assign('categories', $categories);
	$smarty->assign('totalclubs', $lists);
	$smarty->assign('row', $row);