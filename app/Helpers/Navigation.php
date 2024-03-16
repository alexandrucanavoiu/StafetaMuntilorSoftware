<?php

namespace App\Helpers;

use App\Models\Stages;
use App\Models\Category;
use App\Models\RaidmontanStations;
use App\Models\RaidmontanStationsStages;
use App\Models\OrienteeringStationsStages;
use App\Models\OrganizerStage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;


class Navigation
{

    public static function trophy($stageid)
    {
        $trophy = Stages::where('id', $stageid)->first();
        return $trophy;
    }

    public static function trophy_details()
    {
        $trophy_details = OrganizerStage::where('id', 1)->first();
        return $trophy_details;
    }

    public static function setup_orienteering_stations_stages($stageid, $category_id)
    {
        $orienteering_setup_stages = OrienteeringStationsStages::where('stage_id', $stageid)->where('category_id', $category_id)->get();
        if ($orienteering_setup_stages->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

    public static function setup_raid_montan_stages($stageid, $category_id)
    {
        $raidmontan_setup_stages = RaidmontanStationsStages::where('stage_id', $stageid)->where('category_id', $category_id)->get();
        if ($raidmontan_setup_stages->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

    public static function setup_raid_montan($stageid, $category_id)
    {
        $raidmontan_setup = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $category_id)->get();
        if ($raidmontan_setup->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

    public static function categories()
    {
        $categories = Category::OrderBy('id', 'ASC')->get();
        if (!is_array($categories)) {
            return $categories;
        } else {
            return '';
        }
    }

    public static function stages()
    {
        $stages = Stages::OrderBy('id', 'ASC')->get();
        if (!is_array($stages)) {
            return $stages;
        } else {
            return '';
        }
    }

    public static function isActiveRoute($routes, $output = 'active')
    {
        if (!is_array($routes)) {
            $routes = [$routes];
        }
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) {
                return $output;
            }
        }
        return ''; // Route is not active, return default result
    }

    public static function isActiveRouteSubMeniu($routes, $output = 'open')
    {
        if (!is_array($routes)) {
            $routes = [$routes];
        }
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) {
                return $output;
            }
        }
        return ''; // Route is not active, return default result
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


}
