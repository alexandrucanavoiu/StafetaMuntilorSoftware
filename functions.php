<?php

use Aura\Session\Session;
use Stafeta\Station;

require_once 'functions.compat.php';

function getStationLabel($station)
{
    return Station::getLabel($station);
}

function getStationName($station)
{
    return Station::getName($station);
}

function url($uri, $params = array())
{
    $path = '/stafeta/';

    $query = (empty($params) ? '' : '&' . http_build_str($params));
    $uri = $path . '?page=' . $uri . $query;

    return $uri;
}

function redirect($uri, $params = array())
{
    $url = url($uri, $params);
    header('Location: ' . $url);
    exit;
}

function stringToSeconds($string)
{
    $hours = $minutes = $seconds = 0;
    sscanf($string, "%d:%d:%d", $hours, $minutes, $seconds);

    $totalSeconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

    return $totalSeconds;
}
function secondsToString($seconds)
{
    $t = round($seconds);
    return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
}

/**
 * Sort array by key
 * @param array $array Array to be sorted
 * @param string $key Array key to sort by
 * @param int $order Sort order (SORT_ASC/SORT_DESC)
 * @return array Sorted array
 */
function fn_sort_array_by_key($array, $key, $order = SORT_ASC)
{
    $result = array();
    $values = array();
    foreach ($array as $id => $value) {
        $values[$id] = isset($value[$key]) ? $value[$key] : '';

        if (!is_numeric($values[$id])) {
            $values[$id] = strtolower($values[$id]);
        }
    }

    if ($order == SORT_ASC) {
        asort($values);
    } else {
        arsort($values);
    }

    foreach ($values as $key => $value) {
        $result[$key] = $array[$key];
    }

    return $result;
}

function getMessages($segmentName)
{
    global $session;

    $segment = $session->getSegment($segmentName);
    $hashes = isset($_SESSION[Session::FLASH_NOW][$segmentName]) ? array_keys($_SESSION[Session::FLASH_NOW][$segmentName]) : array();
    $messages = array();
    foreach ($hashes as $hash) {
        $messages[] = $segment->getFlash($hash);
    }

    return $messages;
}

function addMessage($message, $segmentName)
{
    global $session;
    $segment = $session->getSegment($segmentName);
    $hash = md5($message);
    $segment->setFlash($hash, $message);
}

function getNotices()
{
    return getMessages('app.notices');
}
function addNotice($message)
{
    addMessage($message, 'app.notices');
}

function getErrors()
{
    return getMessages('app.errors');
}
function addError($message)
{
    addMessage($message, 'app.errors');
}
function getSuccesses()
{
    return getMessages('app.successes');
}
function addSuccess($message)
{
    addMessage($message, 'app.successes');
}

class Database {
    public static function insert($table, $array)
    {
        global $odb;

        $fields = array_keys($array);
        $values = array();
        $placeholders = array();

        foreach ($array as $field => $value) {
            $placeholder = ':' . $field;
            $placeholders[] = $placeholder;
            $values[$placeholder] = $value;
        }

        $placeholders = implode(',', $placeholders);
        $fields = implode(',', $fields);

        $query = 'INSERT INTO ' . $table . ' (' . $fields . ') VALUES (' . $placeholders . ')';
        $statement = $odb->prepare($query);
        foreach ($values as $placeholder => $value) {
            $statement->bindParam($placeholder, $values[$placeholder]);
        }
        $statement->execute();

        return $odb->lastInsertId();
    }

    public static function update($table, $data, $where)
    {
        global $odb;

        $sets = array();
        $values = array();
        foreach ($data as $field => $value) {
            $placeholder = ':' . $field;
            $values[$placeholder] = $value;
            $sets[] = $field . ' = ' . $placeholder;
        }
        $sets = implode(',', $sets);
        $condition = array();
        $conditionValues = array();
        foreach ($where as $field => $value) {
            $placeholder = ':' . $field;
            $condition[] = $field . ' = ' . $placeholder;
            $conditionValues[$placeholder] = $value;
        }
        $condition = implode(' AND ', $condition);

        $query = 'UPDATE ' . $table . ' SET ' . $sets . ' WHERE ' . $condition. '';
        $statement = $odb->prepare($query);

        foreach ($values as $placeholder => $value) {
            $statement->bindParam($placeholder, $values[$placeholder]);
        }
        foreach ($conditionValues as $placeholder => $value) {
            $statement->bindParam($placeholder, $conditionValues[$placeholder]);
        }

        $statement->execute();
    }


    public static function delete($table, $where, $debug=false)
    {
        global $odb;

        $condition = array();
        $conditionValues = array();
        foreach ($where as $field => $value) {
            $placeholder = ':' . $field;
            $condition[] = $field . ' = ' . $placeholder;
            $conditionValues[$placeholder] = $value;
        }
        $condition = implode(' AND ', $condition);

        $query = 'DELETE FROM ' . $table . ' WHERE ' . $condition. '';
        $statement = $odb->prepare($query);

        foreach ($conditionValues as $placeholder => $value) {
            $statement->bindParam($placeholder, $conditionValues[$placeholder]);
        }

        $statement->execute();
    }
}

