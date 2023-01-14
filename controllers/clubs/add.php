<?php

global $odb, $smarty;

$message = "";
$club_name = "";

if (isset($_POST['club_name'])) {
    foreach ($_POST['club_name'] as $obj => $key_1) {

        $query = $odb->prepare("INSERT INTO clubs (club_name,scor_cultural) VALUES (:club_name,0)");
        $query->bindParam(":club_name", $key_1);

        if ($query->execute()) {
            addSuccess("Clubul a fost adaugat");
        } else {
            addError("Clubul nu a fost adaugat");
        }
    }
    redirect('clubs/lists');
} else {
    $addclub = array();
    $addclub['name_club'] = "";
}

$number_club = 1;


$smarty->assign('number_club', $number_club);
$smarty->assign('totalclubs', $addclub);