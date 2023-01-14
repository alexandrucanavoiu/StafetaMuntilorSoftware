<?php

global $odb, $smarty;

$message = "";
$name_trophy = $_POST['name_trophy'];
$name_organizer = $_POST['name_organizer'];
$phase_trophy = $_POST['phase_trophy'];
				
$addorganizer = $odb->prepare("INSERT INTO organizer (name_trophy, name_organizer, phase_trophy) VALUES (:name_trophy, :name_organizer, :phase_trophy)");
$addorganizer->bindParam(":name_trophy", $name_trophy);
$addorganizer->bindParam(":name_organizer", $name_organizer);
$addorganizer->bindParam(":phase_trophy", $phase_trophy);
$addorg = $addorganizer->fetchAll();

if ( isset($_POST['Trimite'])) {

		$addorganizer->execute();
		$message = "Datele au fost adaugate";
	
	// header("Location: /stafeta/?page=challenges/configure");
} else {
	$addorg = array();
	$addorg['name_trophy'] = ""; 
	$addorg['name_organizer'] = ""; 
	$addorg['phase_trophy'] = ""; 
}

$smarty->assign('addorg', $addorg);