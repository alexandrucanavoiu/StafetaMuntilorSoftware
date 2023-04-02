<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Team;
use App\Models\Category;
use App\Models\RaidmontanParticipations;
use App\Models\RaidmontanParticipationsEntries;
use App\Models\RaidmontanStations;
use App\Models\RaidmontanStationsStages;
use DB;

class RaidMontanController extends Controller
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
    public function index($id)
    {
        $category = Category::find($id);
        if($category == null) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Categoria nu exista! URL-ul nu se editeaza manual...',
                'alert-type' => 'error'
            );
            return redirect()->route('dashboard')->with($notification);
        } else {
            $teams = Team::with('raidmontan_participations')->with('raidmontan_participations_entries')->where('category_id', $id)->get();
            $number = 1;
            return view('raidmontan.index',compact('category', 'teams', 'number'));
        }
    }

    public function edit($categoryid, $teamid, Request $request)
    {
        if( $request->ajax() )
        {

            $team = Team::with('category')->FindOrFail($teamid);
            $category = Category::FindOrFail($categoryid);
            if($team == null || $category == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Categoria sau Echipa nu exista in baza de date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('raidmontan.index', $category->id)->with($notification);
            } else {

                $RaidmontanStations = RaidmontanStations::where('category_id', $category->id)->get();
                $RaidmontanStationsStages = RaidmontanStationsStages::where('category_id', $category->id)->get();
                
                if($RaidmontanStations->isEmpty() == true || $RaidmontanStationsStages->isEmpty() == true){
                    $ajax_redirect_url = route('setup.index');
                    $ajax_message_response = "Nu ati configurat Proba de Raid Montan corect. Verificati Traseu de raid si Statiile pentru Raid pentru aceasta categorie in sectiunea 'Configurare'.";
                    $ajax_title_response = "Eroare!";
                    $ajax_status_response = "error";
                    return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 450);
                }


                $raidmontan_participations = RaidmontanParticipations::where('team_id', $teamid)->first();
                $station_type_one = 1;
                $station_type_two = 1;
                // if the team is not already in raidmontan_participations table, populate the blade with some temporary records.
                if($raidmontan_participations == null){
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('raidmontan.create', ['team' => $team, 'category' => $category, 'RaidmontanStations' => $RaidmontanStations, 'station_type_one' => $station_type_one, 'station_type_two' => $station_type_two])->render()
                    ] );
                } else {
                    // if the team already have records in raidmontan_participations table get the data and populate the blade
                    $raidmontan_participations = RaidmontanParticipations::where('team_id', $teamid)->first();
                    $RaidmontanParticipationsEntries = RaidmontanParticipationsEntries::with('RaidmontanStations')->where('team_id', $team->id)->get();
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('raidmontan.edit', ['team' => $team, 'category' => $category, 'RaidmontanParticipationsEntries' => $RaidmontanParticipationsEntries, 'raidmontan_participations' => $raidmontan_participations, 'station_type_one' => $station_type_one, 'station_type_two' => $station_type_two])->render()
                    ] );
                }
            }

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('raidmontan.index', $categoryid)->with($notification);
        }
    }


    public function update($categoryid, $teamid, Request $request)

    {
        if( $request->ajax() )
        {
            $team = Team::FindOrFail($teamid);
            $category = Category::FindOrFail($categoryid);

                if($team == null || $category == null ) {
                    $notification = array(
                        'success_title' => 'Eroare!!',
                        'message' => 'Categoria sau Echipa nu exista in baza de date!',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('orienteering.index', $categoryid)->with($notification);
                } else {

                    $rules = [
                        'missing_footwear' => 'required',
                        'missing_equipment_items' => 'required|numeric|between:0,100',
                        'minimum_distance_penalty' => 'required',
                        'abandon' => 'required|numeric|between:0,2',
                    ];
        
                    if($request->input('missing_footwear') == "true"){
                        $request->merge(['missing_footwear' => 1]);
                    } else {
                        $request->merge(['missing_footwear' => 0]);
                    }

                    if($request->input('minimum_distance_penalty') == "true"){
                        $request->merge(['minimum_distance_penalty' => 1]);
                    } else {
                        $request->merge(['minimum_distance_penalty' => 0]);
                    }

                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['team_id' => $team->id]);
                    $request->merge(['category_id' => $category->id]);

                    $station_start = $request->input('station_start');
                    $station_finish = $request->input('station_finish');
                    $pfa_stations = [];
                    $pfa_stations = explode(',', $request->input('pfa_stations'));
                    $pa_stations = json_decode($request->input('pa_stations'), true);

                    $data = $request->only(['missing_footwear', 'minimum_distance_penalty', 'missing_equipment_items', 'created_at', 'updated_at', 'category_id', 'team_id', 'abandon']);
                    $validator = Validator::make($data, $rules);

                    // validate stations Start / Finish to not be empty if status (abandon = 0) is ok.
                    if($station_start == '00:00:00' && $data['abandon'] == "0" ||  $station_finish == '00:00:00' && $data['abandon'] == "0"){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'Verificati timpii introdusi, Start Time si Finish Time, par sa fie necompletati iar Status este OK');
                        });
                    }

                    // validate stations PA not to be data wrong
                    $count_pa_stations = count($pa_stations) - 1;
                    $station_start_unixtime = strtotime($station_start);
                    $station_finish_unixtime = strtotime($station_finish);

                    if($station_start_unixtime > $station_finish_unixtime){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'Verificati timpii introdusi, Start Time si Finish Time');
                        });
                    }

                    foreach($pa_stations as $key => $pa){
                        $time_start_unixtime = strtotime($pa['time_start']);
                        $time_finish_unixtime = strtotime($pa['time_finish']);

                        if($time_start_unixtime > $time_finish_unixtime){
                            $validator->after(function ($validator) {
                                $validator->errors()->add('form_corruption', 'Verificati timpii introdusi, intre PA-URI');
                            });
                        }

                        if($key == 0){
                            if($station_start_unixtime > $time_start_unixtime || $station_start_unixtime > $station_finish_unixtime) {
                                $validator->after(function ($validator) {
                                    $validator->errors()->add('form_corruption', 'Verificati timpii introdusi, Start Time si PA 1 Start');
                                });
                            }
                        } else {
                            $time_finish_unixtime_other = strtotime($pa_stations[$key-1]['time_finish']);
                            if($time_finish_unixtime_other > $time_start_unixtime) {
                                $validator->after(function ($validator) {
                                    $validator->errors()->add('form_corruption', 'Verificati timpii introdusi... eroare validare timpi intre PA-uri');
                                });
                            }
                        }

                        // echo "<pre>";
                        // echo $key . "<br />";
                        // echo "time_finish_unixtime: " . $time_finish_unixtime . "<br />";
                        // echo "station_finish_unixtime: " . $station_finish_unixtime . "<br />";;
                        // echo $key . "<br />";
                        // echo "</pre>";
                        if($time_finish_unixtime > $station_finish_unixtime) {
                            $validator->after(function ($validator) {
                                $validator->errors()->add('form_corruption', 'Verificati timpii introdusi...');
                            });
                        }

                    }

                    $raidmontan_stations_final = [];
                    $pa_stations_count = 0;
                    $pfa_stations_count = 0;

                    // validate stations Start / Finish to not be empty if status (abandon = 0) is ok.
                    if($station_start == '00:00:00' && $data['abandon'] == "0" ||  $station_finish == '00:00:00' && $data['abandon'] == "0"){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'Verificati timpii introdusi, Start Time si Finish Time, par sa fie necompletati iar Status este OK');
                        });
                    }

                    if($validator->passes())
                    {

                    $RaidmontanParticipations = RaidmontanParticipations::where('team_id', $team->id)->first();
                    $raidmontan_stations = RaidmontanStations::where('category_id', $data['category_id'])->get();

                        if($RaidmontanParticipations == null) {
                            // If the team is not in RaidmontanParticipations table insert the data
                            RaidmontanParticipations::insert([
                                'team_id' => $data['team_id'],
                                'missing_equipment_items' => $data['missing_equipment_items'],
                                'missing_footwear' => $data['missing_footwear'],
                                'minimum_distance_penalty' => $data['minimum_distance_penalty'],
                                'abandon' => $data['abandon'],
                                'created_at' => $data['created_at'],
                                'updated_at' => $data['updated_at']
                            ]);

                            $RaidmontanParticipations = RaidmontanParticipations::where('team_id', $team->id)->first();

                            foreach($raidmontan_stations as $key => $station){
                        
                                $raidmontan_stations_final[$key]['raidmontan_participations_id'] = $RaidmontanParticipations->id;
                                $raidmontan_stations_final[$key]['team_id'] = $team->id;
                                $raidmontan_stations_final[$key]['raidmontan_stations_id'] = $station->id;
                                $raidmontan_stations_final[$key]['raidmontan_stations_station_type'] = $station->station_type;
                                
                                if($station->station_type == 0) {
                                    $raidmontan_stations_final[$key]['time_start'] = $station_start;
                                    $raidmontan_stations_final[$key]['time_finish'] = NULL;
                                    $raidmontan_stations_final[$key]['hits'] = NULL;
                                }
        
                                if($station->station_type == 1) {
                                    $raidmontan_stations_final[$key]['time_start'] = $pa_stations[$pa_stations_count]['time_start'];
                                    $raidmontan_stations_final[$key]['time_finish'] = $pa_stations[$pa_stations_count]['time_finish'];
                                    $raidmontan_stations_final[$key]['hits'] = NULL;
                                    $pa_stations_count++;
                                }
        
                                if($station->station_type == 2) {
                                    $raidmontan_stations_final[$key]['time_start'] = NULL;
                                    $raidmontan_stations_final[$key]['time_finish'] = NULL;
                                    $raidmontan_stations_final[$key]['hits'] = ($pfa_stations[$pfa_stations_count] == 'false') ? 1 : 0;
                                    $pfa_stations_count++;
                                }
        
                                if($station->station_type == 3) {
                                    $raidmontan_stations_final[$key]['time_start'] = NULL;
                                    $raidmontan_stations_final[$key]['time_finish'] = $station_finish;
                                    $raidmontan_stations_final[$key]['hits'] = NULL;
                                }
        
                                $raidmontan_stations_final[$key]['created_at'] = $data['created_at'];
                                $raidmontan_stations_final[$key]['updated_at'] = $data['updated_at'];
                                
                            }
                        
                            RaidmontanParticipationsEntries::insert($raidmontan_stations_final);

                            $ajax_redirect_url = route('raidmontan.index', [$categoryid, $teamid]);
                            $ajax_message_response = "Datele au fost adaugate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
                        } else {
                            // If the team exist in raidmontan table update the data without created_at.

                            RaidmontanParticipations::where('team_id', '=', $data['team_id'])->delete();
                            RaidmontanParticipationsEntries::where('team_id', '=', $data['team_id'])->delete();


                            RaidmontanParticipations::insert([
                                'team_id' => $data['team_id'],
                                'missing_equipment_items' => $data['missing_equipment_items'],
                                'missing_footwear' => $data['missing_footwear'],
                                'minimum_distance_penalty' => $data['minimum_distance_penalty'],
                                'abandon' => $data['abandon'],
                                'created_at' => $data['created_at'],
                                'updated_at' => $data['updated_at']
                            ]);


                            $RaidmontanParticipations = RaidmontanParticipations::where('team_id', $team->id)->first();

                            foreach($raidmontan_stations as $key => $station){
                        
                                $raidmontan_stations_final[$key]['raidmontan_participations_id'] = $RaidmontanParticipations->id;
                                $raidmontan_stations_final[$key]['team_id'] = $team->id;
                                $raidmontan_stations_final[$key]['raidmontan_stations_id'] = $station->id;
                                $raidmontan_stations_final[$key]['raidmontan_stations_station_type'] = $station->station_type;
                                
                                if($station->station_type == 0) {
                                    $raidmontan_stations_final[$key]['time_start'] = $station_start;
                                    $raidmontan_stations_final[$key]['time_finish'] = NULL;
                                    $raidmontan_stations_final[$key]['hits'] = NULL;
                                }
        
                                if($station->station_type == 1) {
                                    $raidmontan_stations_final[$key]['time_start'] = $pa_stations[$pa_stations_count]['time_start'];
                                    $raidmontan_stations_final[$key]['time_finish'] = $pa_stations[$pa_stations_count]['time_finish'];
                                    $raidmontan_stations_final[$key]['hits'] = NULL;
                                    $pa_stations_count++;
                                }
        
                                if($station->station_type == 2) {
                                    $raidmontan_stations_final[$key]['time_start'] = NULL;
                                    $raidmontan_stations_final[$key]['time_finish'] = NULL;
                                    $raidmontan_stations_final[$key]['hits'] = ($pfa_stations[$pfa_stations_count] == 'false') ? 1 : 0;
                                    $pfa_stations_count++;
                                }
        
                                if($station->station_type == 3) {
                                    $raidmontan_stations_final[$key]['time_start'] = NULL;
                                    $raidmontan_stations_final[$key]['time_finish'] = $station_finish;
                                    $raidmontan_stations_final[$key]['hits'] = NULL;
                                }
        
                                $raidmontan_stations_final[$key]['created_at'] = $data['created_at'];
                                $raidmontan_stations_final[$key]['updated_at'] = $data['updated_at'];
                                
                            }
                        
                            RaidmontanParticipationsEntries::insert($raidmontan_stations_final);

                            $ajax_redirect_url = route('raidmontan.index', [$categoryid, $teamid]);
                            $ajax_message_response = "Datele au fost actualizate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);

                        }
                    } else {
                        return Response::json(['errors' => $validator->errors()]);
                    }
                }
        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation. The administrator was notified.',
                'alert-type' => 'error'
            );
            return redirect()->route('dashboard')->with($notification);
        }
    }


}
