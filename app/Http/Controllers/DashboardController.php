<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use DB;
use App\Models\RaidmontanStations;
use App\Models\RaidmontanStationsStages;
use App\Models\OrienteeringStationsStages;
use App\Models\RaidmontanParticipations;
use App\Models\RaidmontanParticipationsEntries;
use App\Models\Orienteering;
use App\Models\Category;
use App\Models\Knowledge;
use App\Models\Cultural;
use App\Models\Club;
use App\Models\Team;
use App\Models\Stages;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     public function switch_change($stageid)
     {
         $stage = Stages::where('id', $stageid)->first();
         if($stage == null){
             $notification = array(
                 'success_title' => 'Eroare!!',
                 'message' => 'StageID-ul nu este valid. Incercati sa nu modificati url-urile de mana.',
                 'alert-type' => 'error'
             );
             return response()->json([
                 'error' => $notification
             ], 400);
         }
     
         // Assuming you have a route named 'dashboard'
         $redirectUrl = route('dashboard', $stage);
     
         return response()->json([
             'redirect_url' => $redirectUrl
         ]);
     }


     public function stages()
     {
        $stages = Stages::get();
         return view('stages',compact('stages'));
     }

    public function index($stageid)
    {
        // $stageid = 1;
        // return view('changelog', compact('stageid'));
        $count_clubs = Club::get()->count();
        $count_teams = Team::where('stage_id', $stageid)->get()->count();

        $teams = Team::where('stage_id', $stageid)->get();
        $stages = Stages::get();
        
        return view('dashboard',compact('count_clubs', 'count_teams', 'stageid', 'stages'));
    }

    public function changelog($stageid)
    {

        $stage = Stages::where('id', $stageid)->first();
        if($stage == null){
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'StageID-ul nu este valid. Incercati sa nu modificati url-urile de mana.',
                'alert-type' => 'error'
            );
            return response()->json([
                'error' => $notification
            ], 400);
        }

        return view('changelog',compact('stageid'));
    }

    public function terms($stageid)
    {
        $stage = Stages::where('id', $stageid)->first();
        if($stage == null){
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'StageID-ul nu este valid. Incercati sa nu modificati url-urile de mana.',
                'alert-type' => 'error'
            );
            return response()->json([
                'error' => $notification
            ], 400);
        }
        return view('terms',compact('stageid'));
    }

}
