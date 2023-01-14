<?php
/**
 * Created by PhpStorm.
 * User: WSergio
 * Date: 20/06/2015
 * Time: 17:42:37 PM
 */
use Stafeta\Categories;
use Stafeta\Challenges;

global $odb, $smarty;

$categories = Categories::get();
$smarty->assign('categories', $categories);
$challenges = Challenges::get();

if ($_POST) {
    $tables = !empty($_POST['tables']) ? $_POST['tables'] : array();
    $tables = array_reverse($tables);
    $hasErrors = false;

    foreach ($tables as $relatedTables) {
        $relatedTables = explode(',', $relatedTables);
        foreach ($relatedTables as $table) {
            try {
                $statement = $odb->prepare("TRUNCATE TABLE `$table`");
                $statement->execute();
            } catch (Exception $e) {
                addError("Eroare la ștergerea tabelului „$table„: " . $e->getMessage());
                $hasErrors = true;
            }
        }
    }
    if (!$hasErrors) {
        addSuccess("Datele au fost șterse!");
    }

    redirect('challenges/configure');
}


$smarty->assign('challenges', $challenges);

$tables = array(
    'Cluburi' => array('clubs')
    , 'Echipe' => array('teams')
    , 'Configurari proba "Raid Montan"' => array('category_challenges', 'challenge_stations')
    , 'Rezultate proba "Raid Montan"' => array('participation_entries', 'participations')
    , 'Rezultate proba "Climbing"' => array('climbing')
    , 'Rezultate proba "Cunostinte Turistice"' => array('knowledge')
    , 'Rezultate proba "Orientare"' => array('orienteering')
);
$smarty->assign('tables', $tables);