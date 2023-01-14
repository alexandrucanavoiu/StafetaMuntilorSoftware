<?php

if (isset($_POST['club_id'])) {

    $club_id = $_REQUEST['club_id'];
    $club_name = $_REQUEST['club_name'];
    $sql = "UPDATE `clubs` SET `club_name` = :club_name WHERE `club_id` = :club_id";
    $update = $odb->prepare($sql);
    $update->bindValue(":club_id", $club_id);
    $update->bindValue(":club_name", $club_name);
    if ($update->execute()) {
        addSuccess("Modificările au fost salvate");
    } else {
        addError("Modificările nu au fost salvate");
    }

    redirect('clubs/lists');
}

if (isset($_REQUEST['club_id']) && is_numeric($_REQUEST['club_id'])) {
    // get id value
    $club_id = $_REQUEST['club_id'];

    $sql = $odb->prepare("SELECT * FROM clubs WHERE club_id = :club_id");
    $sql->bindParam(':club_id', $club_id, PDO::PARAM_INT);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);

}

$smarty->assign('club_id', $club_id);
$smarty->assign('club_name', $club_name);
$smarty->assign('row', $row);