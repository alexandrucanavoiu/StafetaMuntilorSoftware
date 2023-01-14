<?php
use Stafeta\Categories;

global $odb, $smarty;

$team_name = $_POST['team_name'];
$club_id = $_POST['club_id'];
$category_id = $_POST['category_id'];

if (isset($_POST['team_name'])) {
    foreach ($_POST['team_name'] as $index => $team_name) {
        $club_id = $_POST['club_id'];
        $category_id = $_POST['category_id'][$index];
        $query = $odb->prepare("INSERT INTO `teams` (`team_name`, `club_id`, `category_id`) VALUES (:team_name, :club_id, :category_id)");
        $query->bindParam(":team_name", $team_name);
        $query->bindParam(":club_id", $club_id);
        $query->bindParam(":category_id", $category_id);
        if ($query->execute()) {
            addSuccess("Echipa a fost adaugată");
        } else {
            addError("Echipa nu a fost adaugată");
        }
        $message = "Datele au fost adaugate";
    }
    redirect('teams/lists');
} else {
    $addteam = array();
    $addteam['team_name'] = "";
}

//var_dump ( $_POST );

$teamslists = $odb->query("SELECT * FROM teams");
$teamslists->execute();
$liststeams = $teamslists->fetchAll();


$clubslists = $odb->query("SELECT * FROM clubs");
$clubslists->execute();
$listsclubs = $clubslists->fetchAll();

$categories = Categories::get();

$smarty->assign('categories', $categories);
$smarty->assign('teams', $liststeams);
$smarty->assign('totalclubs', $listsclubs);
