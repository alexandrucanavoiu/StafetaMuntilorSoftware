<?php

global $odb, $smarty;

use Stafeta\Club;
use Stafeta\Clubs;

if (isset($_GET['club_id']) && is_numeric($_GET['club_id'])) {
    $clubId = intval($_GET['club_id']);
    $club = Club::get($clubId);
    try {
        Clubs::delete($clubId);
        addNotice('Clubul "' . $club['club_name'] . '" a fost șters!');
    } catch (Exception $e) {
        addError('Clubul "' . $club['club_name'] . '" nu a fost șters din cauza unei erori: ' . $e->getMessage());
    }
}
redirect('clubs/lists');
