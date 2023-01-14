<?php

global $odb, $smarty;

$clubslists = $odb->query("SELECT * FROM clubs");
$clubslists->execute();
$listsclubs = $clubslists->fetchAll();


$smarty->assign('listsclubs', $listsclubs);