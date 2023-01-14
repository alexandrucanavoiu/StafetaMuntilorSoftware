<?php


namespace Stafeta;


class Utils {

    /**
     * @param $items
     * @param $fields
     * @param null $reindexByKey
     * @return array
     */
    public static function multiSort($items, $fields, $reindexByKey = null)
    {
        if (empty($items)) {
            return array();
        }

        $sort = array();
        foreach($items as $k => $v) {
            foreach ($fields as $field => $sortOrder) {
                $sort[$field][$k] = $v[$field];
            }
        }

        $args = array();
        foreach ($fields as $field => $sortOrder) {
            $args[] = $sort[$field];
            $args[] = $sortOrder;
        }
        $args[] = &$items;
        call_user_func_array('array_multisort', $args);

        if ($reindexByKey !== null) {
            $items = Utils::setArrayKey($items, $reindexByKey);
        }

        return $items;
    }

    public static function setArrayKey($array, $key)
    {
        $_array = $array;
        $array = array();
        foreach ($_array as $k => $v) {
            $array[$v[$key]] = $v;
        }

        return $array;
    }
}