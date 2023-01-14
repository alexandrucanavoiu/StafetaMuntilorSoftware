<?php


namespace Stafeta;

use Aura\Session\Exception;
use PDO;
use PDOException;

class Clubs {
    public static function groupTeamsByClub($teams)
    {
        $clubsTeams = array();
        foreach ($teams as $i => $team) {
            $cid = $team['club_id'];
            $tid = $team['team_id'];
            if (!isset($clubsTeams[$cid])) {
                $clubsTeams[$cid] = array();
            }
            $clubsTeams[$cid][$tid] = $team;
        }
        return $clubsTeams;
    }
    public static function get()
    {
        global $odb;

        $statement = $odb->query("SELECT * FROM clubs");
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $items;
    }

    public static function delete($clubId)
    {
        global $odb;
        Teams::deleteByClub($clubId);

        try {
            $sql = "DELETE FROM clubs WHERE club_id =  :club_id";
            $stmt = $odb->prepare($sql);
            $stmt->bindParam(':club_id', $_GET['club_id'], PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }

        return true;
    }
} 