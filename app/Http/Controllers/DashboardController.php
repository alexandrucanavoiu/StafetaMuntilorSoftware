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
use App\Models\OrganizerStage;
use App\Models\Orienteering;
use App\Models\Category;
use App\Models\Knowledge;
use App\Models\Cultural;
use App\Models\Club;
use App\Models\Team;

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
    public function index()
    {
        $count_clubs = Club::get()->count();
        $count_teams = Team::get()->count();

        $teams = Team::get();
        
        return view('dashboard',compact('count_clubs', 'count_teams'));
    }

    public function changelog()
    {
        return view('changelog');
    }

    public function terms()
    {
        return view('terms');
    }

}
