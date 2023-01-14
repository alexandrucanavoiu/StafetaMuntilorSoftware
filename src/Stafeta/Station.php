<?php

namespace Stafeta;


class Station {
    CONST TYPE_START = 0;
    CONST TYPE_PA = 1;
    CONST TYPE_PFA = 2;
    CONST TYPE_FINISH = 3;

    public static function getTypes()
    {
        return array(
            Station::TYPE_START => 'Start',
            Station::TYPE_PA => 'Post cu Arbitru (PA)',
            Station::TYPE_PFA => 'Post fara Arbitru (PFA)',
            Station::TYPE_FINISH => 'Finish',
        );
    }

    public static function getLabel($station, $index = null)
    {
        $types = array('S', 'PA', 'PFA', 'F');
        $type = $station['station_type'];
        $label = isset($types[$type]) ? $types[$type] : 'X';

        if ($index !== null && in_array($type, array(self::TYPE_PFA, self::TYPE_PA))) {
            $label .= '-'.$index;
        }

        return $label;
    }

    public static function getName($station)
    {
        $types = self::getTypes();

        return $types[$station['station_type']];
    }

    public static function setLabels(&$items)
    {
        $index = array();
        foreach ($items as $i => $item) {
            $type = $item['station_type'];
            if (!isset($index[$type])) {
                $index[$type] = 0;
            }
            $index[$type]++;
            $items[$i]['label'] = Station::getLabel($item, $index[$type]);
        }
    }
}