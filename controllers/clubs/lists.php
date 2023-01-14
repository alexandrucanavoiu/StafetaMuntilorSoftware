<?php

global $odb, $smarty;

$clubslists = $odb->query("SELECT * FROM clubs");
$clubslists->execute();
$lists = $clubslists->fetchAll();

$number = 1;


$smarty->assign('totalclubs', $lists);
$smarty->assign('number', $number);