<?php

global $odb, $smarty;

use Stafeta\Team;

	if (isset($_GET['team_id']) && is_numeric($_GET['team_id'])) {
		// get id value
		$id = $_GET['team_id'];


		$team = Team::get($id);
			try {
				Team::delete($id);
				addNotice('Echipa "' . $team['team_name'] . '" a fost ștersă!');
			} catch (Exception $e) {
				addError('Echipa "' . $team['team_name'] . '" nu a fost ștersă din cauza unei erori: ' . $e->getMessage());
			}
	}

	redirect('teams/lists');
