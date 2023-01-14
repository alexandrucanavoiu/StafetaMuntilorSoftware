<?php

namespace App\Helpers;

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

    public static function trophy_details()
    {
        $trophy_details = OrganizerStage::where('id', 1)->first();
        return $trophy_details;
    }

    public static function setup_trophy()
    {
        $trophy_setup = OrganizerStage::where('id', 1)->first();
        if ($trophy_setup->name_stage == "Trofeul Stafeta Muntilor" || $trophy_setup->name_organizer == "Asociatia Stafeta Muntilor") {
            return false;
        } else {
            return true;
        }
    }

    public static function setup_orienteering_stations_stages($category_id)
    {
        $orienteering_setup_stages = OrienteeringStationsStages::where('category_id', $category_id)->get();
        if ($orienteering_setup_stages->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

    public static function setup_raid_montan_stages($category_id)
    {
        $raidmontan_setup_stages = RaidmontanStationsStages::where('category_id', $category_id)->get();
        if ($raidmontan_setup_stages->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

    public static function setup_raid_montan($category_id)
    {
        $raidmontan_setup = RaidmontanStations::where('category_id', $category_id)->get();
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
