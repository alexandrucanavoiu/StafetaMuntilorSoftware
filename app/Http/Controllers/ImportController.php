<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Team;
use App\Models\Orienteering;
use App\Models\Category;
use App\Models\RaidmontanStations;
use App\Models\RaidmontanStationsStages;
use App\Models\OrienteeringStationsStages;
use App\Models\RaidmontanParticipations;
use App\Models\RaidmontanParticipationsEntries;
use DB;
use Illuminate\Validation\Rule;
use Excel;
use PDF;
use App\Models\Stages;

class ImportController extends Controller
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
    public function index($stageid)
    {

        $stage = Stages::where('id', $stageid)->first();
        if($stage == null){
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'StageID-ul nu este valid. Incercati sa nu modificati url-urile de mana.',
                'alert-type' => 'error'
            );
            return redirect()->route('error.alert')->with($notification);
        }
        $teams = Team::where('stage_id', $stageid)->count();
        $participations_raidmontan = RaidmontanParticipations::where('stage_id', $stageid)->count();
        $participations_orienteering = Orienteering::where('stage_id', $stageid)->count();

        return view('import.index',compact('teams', 'participations_raidmontan', 'participations_orienteering', 'stageid'));
    }


    public function teams_chipno_and_team_name_check($stageid, Request $request)
    {

        if ($request->hasFile('import_file')) {
    
            $path = $request->file('import_file')->getRealPath();

            // remove all chipno from db
            Team::query()->update(['chipno' => null]);    
    
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $header = str_getcsv(array_shift($lines), ';');
    
            $dataRows = array_map(function ($line) {
                return str_getcsv($line, ';');
            }, $lines);

            $chipnoIndex = null;
            $surnameIndex = null;
            $shortIndex = null;

            foreach ($header as $index => $column) {
                if (trim($column) === 'Chipno') {
                    $chipnoIndex = $index;
                } elseif (trim($column) === 'Surname') {
                    $surnameIndex = $index;
                } elseif (trim($column) === 'Short') {
                    $shortIndex = $index;
                }
            }

            // Optional: validate that all were found
            if (is_null($chipnoIndex) || is_null($surnameIndex) || is_null($shortIndex)) {
                $notification = array(
                    'success_title' => 'Error',
                    'message' => ' One or more required columns (Chipno, Surname, Short) were not found in the header.',
                    'alert-type' => 'error'
                );
                return redirect()->route('import.index', [$stageid])->with($notification); 
            }

            $categories = Category::get();
            $categories_array = [];
            foreach($categories as $category){
                $categories_array[$category->name] = $category->id;
            }


            $teams_with_issue = [];
            $teams_exists = [];
            $teams_exists_but_category_is_wrong = [];
            foreach ($dataRows as $index => $fields) {
                if( !isset($fields[$surnameIndex]) || !isset($categories_array[$fields[$shortIndex]]) ){
                    $notification = array(
                        'success_title' => 'Error',
                        'message' => 'Numele categoriilor din fisierule excel NU corespund cu cele din Statefa Muntilor. Va rugam sa verificati numele categoriilor.',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('import.index', [$stageid])->with($notification); 
                }

                $surnameKey = $fields[$surnameIndex] ?? null;

                $team_exist = Team::where('name', $fields[$surnameIndex])->where('category_id', $categories_array[$fields[$shortIndex]])->where('stage_id', $stageid)->first();
                    if($team_exist !== null && !empty($team_exist->name) && !empty($fields[$chipnoIndex]) && !empty($team_exist->category->name) )
                    {

                        $teams_exists[$team_exist->category_id][$fields[$surnameIndex]]['id'] = $team_exist->id;
                            $teams_exists[$team_exist->category_id][$fields[$surnameIndex]]['name'] = $team_exist->name;
                            $teams_exists[$team_exist->category_id][$fields[$surnameIndex]]['club'] = $team_exist->club->name;
                            $teams_exists[$team_exist->category_id][$fields[$surnameIndex]]['category_name'] = $team_exist->category->name;
                            $teams_exists[$team_exist->category_id][$fields[$surnameIndex]]['category_id'] = $team_exist->category_id;
                            $teams_exists[$team_exist->category_id][$fields[$surnameIndex]]['chipno'] = $fields[$chipnoIndex];
                    } else {
                        $teams_with_issue[$fields[$shortIndex]][$fields[$surnameIndex]]['name'] = $fields[$surnameIndex] ?? 'N/A';
                        $teams_with_issue[$fields[$shortIndex]][$fields[$surnameIndex]]['category_name'] = $fields[$shortIndex] ?? 'N/A';
                        $teams_with_issue[$fields[$shortIndex]][$fields[$surnameIndex]]['chipno'] =  $fields[$chipnoIndex] ?? 'N/A';
                    }
            }


            foreach($teams_exists as $team_in_category){
                foreach($team_in_category as $team){
                    Team::where('id', $team['id'])->where('stage_id', $stageid)->where('category_id', $team['category_id'])->where('name', $team['name'])->update(['chipno' => $team['chipno']]);
                }
            }

            return view('teams.index_chipno',compact('stageid', 'teams_exists', 'teams_with_issue', 'teams_exists_but_category_is_wrong'));
            

        } else {
            $notification = array(
                'success_title' => 'Error',
                'message' => 'No file uploaded.',
                'alert-type' => 'error'
            );
            return redirect()->route('import.index', [$stageid])->with($notification); 
        }


    }

    public function raidmontan_seed($stageid)
    {

        $stage = Stages::where('id', $stageid)->first();
        if($stage == null){
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'StageID-ul nu este valid. Incercati sa nu modificati url-urile de mana.',
                'alert-type' => 'error'
            );
            return redirect()->route('error.alert')->with($notification);
        }

        $teams = Team::where('stage_id', $stageid)->with('category')->get();

        $create_date = date('Y-m-d H:i:s');
        $pa_stations_count = 0;
        $pfa_stations_count = 0;

        foreach($teams as $team){

            $raidmontan_stations_final = [];
            $raidmontan_stations_stages_id = [];

            $check = RaidmontanParticipations::where('stage_id', $stageid)->get()->first();

            if($team->raidmontan_participations !== null){
                continue;

            } else {

                RaidmontanParticipationsEntries::where('stage_id', $stageid)->where('team_id', $team->id)->delete();
                // If the team is not in RaidmontanParticipations table insert the data
                RaidmontanParticipations::insert([
                    'stage_id' => $stageid,
                    'team_id' => $team->id,
                    'missing_equipment_items' => 0,
                    'missing_footwear' => 0,
                    'minimum_distance_penalty' => 0,
                    'abandon' => 1,
                    'created_at' => $create_date,
                    'updated_at' => $create_date
                ]);
    
    
                $RaidmontanParticipations = RaidmontanParticipations::where('stage_id', $stageid)->where('team_id', $team->id)->first();
                $raidmontan_stations = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $team->category_id)->get();
                $raidmontan_stations_stages = RaidmontanStationsStages::where('stage_id', $stageid)->where('category_id', $team->category_id)->get();

                $stage_start_id = 0;
                $stage_finish_id = 0;
                $stage_pa_id = [];
                $stage_pa_id_count = 1;
                $pa_stations_count = 0;
                foreach($raidmontan_stations_stages as $stage){
                    if($stage->post == 251){
                        $stage_start_id = $stage->id;
                    } elseif($stage->post == 252){
                        $stage_finish_id = $stage->id;
                    } else {
                        $stage_pa_id[$pa_stations_count] = $stage->id;
                        $pa_stations_count++;
                    }
    
                }
    
                $pa_stations_count = 0;

                foreach($raidmontan_stations as $key => $station){
            
                    $raidmontan_stations_final[$key]['stage_id'] = $stageid;
                    $raidmontan_stations_final[$key]['raidmontan_participations_id'] = $RaidmontanParticipations->id;
                    $raidmontan_stations_final[$key]['team_id'] = $team->id;
                    $raidmontan_stations_final[$key]['raidmontan_stations_id'] = $station->id;
                    $raidmontan_stations_final[$key]['raidmontan_stations_station_type'] = $station->station_type;
                    
                    if($station->station_type == 0) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_start_id;
                        $raidmontan_stations_final[$key]['time_start'] = "00:00:00";
                        $raidmontan_stations_final[$key]['time_finish'] = NULL;
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                    }
    
                    if($station->station_type == 1) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_pa_id[$pa_stations_count];
                        $raidmontan_stations_final[$key]['time_start'] = "00:00:00";
                        $raidmontan_stations_final[$key]['time_finish'] = "00:00:00";
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                        $pa_stations_count++;
                    }
    
                    if($station->station_type == 2) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = NULL;
                        $raidmontan_stations_final[$key]['time_start'] = NULL;
                        $raidmontan_stations_final[$key]['time_finish'] = NULL;
                        $raidmontan_stations_final[$key]['hits'] = 1;
                        $pfa_stations_count++;
                    }
    
                    if($station->station_type == 3) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_finish_id;
                        $raidmontan_stations_final[$key]['time_start'] = NULL;
                        $raidmontan_stations_final[$key]['time_finish'] = "00:00:00";
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                    }
    
                    $raidmontan_stations_final[$key]['created_at'] = $create_date;
                    $raidmontan_stations_final[$key]['updated_at'] = $create_date;
                    
                }
            
                RaidmontanParticipationsEntries::insert($raidmontan_stations_final);

            }
        }

        $notification = array(
            'success_title' => 'Success',
            'message' => '(RaidMontan) Toate echipele au fost marcate ca Abandon, va rugam sa importati fisierul.',
            'alert-type' => 'success'
        );
        return redirect()->route('import.index', [$stageid])->with($notification);

    }

    public function raidmontan_seed_intern($stageid)
    {

        $stage = Stages::where('id', $stageid)->first();
        if($stage == null){
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'StageID-ul nu este valid. Incercati sa nu modificati url-urile de mana.',
                'alert-type' => 'error'
            );
            return redirect()->route('error.alert')->with($notification);
        }

        $teams = Team::where('stage_id', $stageid)->with('category')->get();

        $create_date = date('Y-m-d H:i:s');
        $pa_stations_count = 0;
        $pfa_stations_count = 0;

        foreach($teams as $team){

            $raidmontan_stations_final = [];
            $raidmontan_stations_stages_id = [];

            if($team->raidmontan_participations !== null){
                continue;

            } else {

                RaidmontanParticipationsEntries::where('team_id', $team->id)->delete();
                // If the team is not in RaidmontanParticipations table insert the data
                RaidmontanParticipations::insert([
                    'stage_id' => $stageid,
                    'team_id' => $team->id,
                    'missing_equipment_items' => 0,
                    'missing_footwear' => 0,
                    'minimum_distance_penalty' => 0,
                    'abandon' => 1,
                    'created_at' => $create_date,
                    'updated_at' => $create_date
                ]);
    
    
                $RaidmontanParticipations = RaidmontanParticipations::where('stage_id', $stageid)->where('team_id', $team->id)->first();
                $raidmontan_stations = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $team->category_id)->get();
                $raidmontan_stations_stages = RaidmontanStationsStages::where('stage_id', $stageid)->where('category_id', $team->category_id)->get();

                $stage_start_id = 0;
                $stage_finish_id = 0;
                $stage_pa_id = [];
                $stage_pa_id_count = 1;
                $pa_stations_count = 0;
                foreach($raidmontan_stations_stages as $stage){
                    if($stage->post == 251){
                        $stage_start_id = $stage->id;
                    } elseif($stage->post == 252){
                        $stage_finish_id = $stage->id;
                    } else {
                        $stage_pa_id[$pa_stations_count] = $stage->id;
                        $pa_stations_count++;
                    }
    
                }
    
                $pa_stations_count = 0;

                foreach($raidmontan_stations as $key => $station){
            
                    $raidmontan_stations_final[$key]['stage_id'] = $stageid;
                    $raidmontan_stations_final[$key]['raidmontan_participations_id'] = $RaidmontanParticipations->id;
                    $raidmontan_stations_final[$key]['team_id'] = $team->id;
                    $raidmontan_stations_final[$key]['raidmontan_stations_id'] = $station->id;
                    $raidmontan_stations_final[$key]['raidmontan_stations_station_type'] = $station->station_type;
                    
                    if($station->station_type == 0) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_start_id;
                        $raidmontan_stations_final[$key]['time_start'] = "00:00:00";
                        $raidmontan_stations_final[$key]['time_finish'] = NULL;
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                    }
    
                    if($station->station_type == 1) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_pa_id[$pa_stations_count];
                        $raidmontan_stations_final[$key]['time_start'] = "00:00:00";
                        $raidmontan_stations_final[$key]['time_finish'] = "00:00:00";
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                        $pa_stations_count++;
                    }
    
                    if($station->station_type == 2) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = NULL;
                        $raidmontan_stations_final[$key]['time_start'] = NULL;
                        $raidmontan_stations_final[$key]['time_finish'] = NULL;
                        $raidmontan_stations_final[$key]['hits'] = 1;
                        $pfa_stations_count++;
                    }
    
                    if($station->station_type == 3) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_finish_id;
                        $raidmontan_stations_final[$key]['time_start'] = NULL;
                        $raidmontan_stations_final[$key]['time_finish'] = "00:00:00";
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                    }
    
                    $raidmontan_stations_final[$key]['created_at'] = $create_date;
                    $raidmontan_stations_final[$key]['updated_at'] = $create_date;
                    
                }
            
                RaidmontanParticipationsEntries::insert($raidmontan_stations_final);

            }
        }

    }

    public function orienteering_seed($stageid)
    {

        $stage = Stages::where('id', $stageid)->first();
        if($stage == null){
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'StageID-ul nu este valid. Incercati sa nu modificati url-urile de mana.',
                'alert-type' => 'error'
            );
            return redirect()->route('error.alert')->with($notification);
        }

        $teams = Team::where('stage_id', $stageid)->with('category')->get();
        $create_date = date('Y-m-d H:i:s');

        foreach($teams as $team){

            $team_orienteering = Orienteering::where('stage_id', $stageid)->where('team_id', $team->id)->first();

            if($team_orienteering == null){
                Orienteering::insert([
                    'stage_id' => $stageid,
                    'team_id' => $team->id,
                    'start_time' => "00:00:00",
                    'finish_time' => "00:00:00",
                    'total_time' => "00:00:00",
                    'abandon' => 1,
                    'missed_posts' => NULL,
                    'order_posts' => NULL,
                    'created_at' => $create_date,
                    'updated_at' => $create_date
                ]);
            } else {
                continue;
            }

        }

        $notification = array(
            'success_title' => 'Success',
            'message' => '(Orientare) Toate echipele au fost marcate ca Abandon, va rugam sa importati fisierul.',
            'alert-type' => 'success'
        );
        return redirect()->route('import.index', [$stageid])->with($notification);

    }

    public function orienteering_import_uuids($stageid, Request $request)
    {

        if ($request->hasFile('import_file')) {
    
            $path = $request->file('import_file')->getRealPath();
    
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $header = str_getcsv(array_shift($lines), ';');
    
            $dataRows = array_map(function ($line) {
                return str_getcsv($line, ';');
            }, $lines);

            $teams = Team::where('stage_id', $stageid)->with('category')->get();
            $categories = Category::get();

            
            $chipnoIndex = null;
            $surnameIndex = null;
            $shortIndex = null;
            $startPunch = null;
            $finishPunch = null;
            $orienteering_stations_array = [];

            foreach($categories as $category){
                $orienteering_stations_category = OrienteeringStationsStages::where('category_id', $category->id)->get();
                $first_post = optional($orienteering_stations_category->first())->post;
                $last_post = optional($orienteering_stations_category->last())->post;
                foreach($orienteering_stations_category as $orienteering_stations){
                    foreach ($header as $index => $column) {
                        if (trim($column) === $orienteering_stations->post) {
                            $orienteering_stations_array[$category->name][$index] = $orienteering_stations->post;
                            if ($orienteering_stations->post === $first_post) {
                                $start_punch_array[$category->name] = $orienteering_stations->post;
                            }
            
                            // Verifică dacă este ultimul
                            if ($orienteering_stations->post === $last_post) {
                                $finish_punch_array[$category->name] = $orienteering_stations->post;
                            }
                        }
                        elseif (trim($column) === 'Chipno') {
                            $chipnoIndex = $index;
                        } elseif (trim($column) === 'Surname') {
                            $surnameIndex = $index;
                        } elseif (trim($column) === 'Short') {
                            $shortIndex = $index;
                        } elseif (trim($column) === 'Start punch') {
                            $startPunch = $index;
                        } elseif (trim($column) === 'Finish punch') {
                            $finishPunch = $index;
                        }
                    }

                }

            }


            // Optional: validate that all were found
            if (is_null($chipnoIndex) || is_null($surnameIndex) || is_null($shortIndex)) {
                $notification = array(
                    'success_title' => 'Error',
                    'message' => ' One or more required columns (Chipno, Surname, Short) were not found in the header.',
                    'alert-type' => 'error'
                );
                return redirect()->route('import.index', [$stageid])->with($notification); 
            }


            $teams_in_stage = [];            
            $teams_with_issue = [];
            
            foreach ($dataRows as $index => $fields) {
                // $surnameKey = $fields[$surnameIndex] ?? null;
                if (!isset($teams_in_stage[$chipnoIndex])) 
                {
                    // Key exists, do something
                    $teams_in_stage[$fields[$chipnoIndex]]['chipno'] = $fields[$chipnoIndex];
                    $teams_in_stage[$fields[$chipnoIndex]]['category_name'] = $fields[$shortIndex];
                    $teams_in_stage[$fields[$chipnoIndex]]['name'] = $fields[$surnameIndex];
                    $teams_in_stage[$fields[$chipnoIndex]]['orienteering_missing'] = 0;
                    $teams_in_stage[$fields[$chipnoIndex]]['start_time'] = '00:00:00';
                    $teams_in_stage[$fields[$chipnoIndex]]['finish_time'] = '00:00:00';
                    $teams_in_stage[$fields[$chipnoIndex]]['total_time'] = '00:00:00';
                    $teams_in_stage[$fields[$chipnoIndex]]['id'] = 0;
                    $teams_in_stage[$fields[$chipnoIndex]]['club'] = '';
                    $teams_in_stage[$fields[$chipnoIndex]]['stations'] = [];

                    $team_exist = Team::where('chipno', $fields[$chipnoIndex])->with('category')->where('stage_id', $stageid)->first();
            
                        if( !empty($team_exist) )
                        {
                            $teams_in_stage[$fields[$chipnoIndex]]['id'] = $team_exist->id;
                            $teams_in_stage[$fields[$chipnoIndex]]['club'] = $team_exist->club->name;

                            foreach($orienteering_stations_array[$fields[$shortIndex]] as $station_key => $station){

                                if( !isset($fields[$station_key]) ){
                                    $notification = array(
                                        'success_title' => 'Error',
                                        'message' => 'Fisierul este incorect, nu sunt setate toate punch-urile corect! Verifica daca nr de posturi de pe categorie corespunde cu cele din excel.',
                                        'alert-type' => 'error'
                                    );
                                    return redirect()->route('import.index', [$stageid])->with($notification); 
                                }
                                if (in_array($fields[$station_key], ["-----", "00:00:00", ""])) {
                                    $teams_in_stage[$fields[$chipnoIndex]]['orienteering_missing'] = 1;
                                }

                                
                                
                                $teams_in_stage[$fields[$chipnoIndex]]['stations'][$station] = date("H:i:s",strtotime($fields[$station_key]));
                            }
                            
                            //Creaza metoda de calcul 1 2 3
                            // 1 - Daca Orientarea este la inceput si dupa raid-ul - Finish-ul trebuie calculat altfel: finish punch - start punch 
                            // 2 - Daca Raid-ul este la inceput si dupa orientare
                            // 3 - Daca Orientarea si Raid-ul sunt pe zile spearate si au Start Punch / Finish Punch ambele
                            // Pentru asta am creat $finish_punch_array

                            if($start_punch_array[$team_exist->category->name] == "Start punch" && $finish_punch_array[$team_exist->category->name] == "Finish punch"){
                                // Metoda 3
                                $start_time_input = reset($teams_in_stage[$fields[$chipnoIndex]]['stations']);
                                if (str_starts_with($start_time_input, "12")) {
                                    $start_time_input = "00" . substr($start_time_input, 2);  // păstrează ":26:17"
                                }
                                $start_time = date("H:i:s",strtotime($start_time_input));

                                $end_time_input = end($teams_in_stage[$fields[$chipnoIndex]]['stations']);
                                if (str_starts_with($end_time_input, "12")) {
                                    $end_time_input = "00" . substr($end_time_input, 2);  // păstrează ":26:17"
                                }
                                $finish_time = date("H:i:s",strtotime($end_time_input));

                                $start_punch_time_convert = \DateTime::createFromFormat('H:i:s', $start_time);
                                $finish_punch_time_convert = \DateTime::createFromFormat('H:i:s', $finish_time);

                                // Verifica diferenta dintre Start si Total timp
                                // Compute the interval
                                $total_time = $start_punch_time_convert->diff($finish_punch_time_convert);
                                // Format the interval as H:M:S
                                $total_time = $total_time->format('%H:%I:%S');

                            } elseif($start_punch_array[$team_exist->category->name] !== "Start punch" && $finish_punch_array[$team_exist->category->name] == "Finish punch"){
                                // Metoda 2

                                //se ia Finish Punch time - Start Punch dupa care se va scadea Start-ul de la orientare pentru total
                                $start_punch_time = date("H:i:s",strtotime($fields[$startPunch]));
                                if (str_starts_with($start_punch_time, "12")) {
                                    $start_punch_time = "00" . substr($start_punch_time, 2);  // păstrează ":26:17"
                                }
                                $finish_punch_time = date("H:i:s",strtotime($fields[$finishPunch]));
                                if (str_starts_with($finish_punch_time, "12")) {
                                    $finish_punch_time = "00" . substr($finish_punch_time, 2);  // păstrează ":26:17"
                                }
                                $start_punch_time_convert = \DateTime::createFromFormat('H:i:s', $start_punch_time);
                                $finish_punch_time_convert = \DateTime::createFromFormat('H:i:s', $finish_punch_time);

                                // Se calculeaza diferenta intre Start Punch si Finish Time pentru a fi scazuta pe viitor
                                // Compute the interval_start_punch_and_finish_time
                                $interval_start_punch_and_finish_time = $start_punch_time_convert->diff($finish_punch_time_convert);
                                // Format the interval as H:M:S
                                $total_interval_start_punch_and_finish_time = $interval_start_punch_and_finish_time->format('%H:%I:%S');
                                // Convertire in datetime
                                $total_interval_start_punch_and_finish_time_date = \DateTime::createFromFormat('H:i:s', $total_interval_start_punch_and_finish_time);

                                // Ia start-ul de Orientare
                                $start_time_input = reset($teams_in_stage[$fields[$chipnoIndex]]['stations']);
                                $start_time = date("H:i:s",strtotime($start_time_input));
                                $start_time_date = \DateTime::createFromFormat('H:i:s', $start_time);

                                // Verifica diferenta dintre Start si Total timp
                                // Compute the interval
                                $interval_start_orientare_and_interval_start_punch_and_finish_time = $start_time_date->diff($total_interval_start_punch_and_finish_time_date);
                                // Format the interval as H:M:S
                                $total_time = $interval_start_orientare_and_interval_start_punch_and_finish_time->format('%H:%I:%S');

                                //Facem replace la Finish Punch cu interval_start_punch_and_finish_time
                                $teams_in_stage[$fields[$chipnoIndex]]['stations']['Finish punch'] = $total_interval_start_punch_and_finish_time;
                                $finish_time = $total_interval_start_punch_and_finish_time;

                            } elseif( $start_punch_array[$team_exist->category->name] == "Start punch" && $finish_punch_array[$team_exist->category->name] !== "Finish punch"){
                                // Metoda 1
                                $start_time_input = reset($teams_in_stage[$fields[$chipnoIndex]]['stations']);
                                if (str_starts_with($start_time_input, "12")) {
                                    $start_time_input = "00" . substr($start_time_input, 2);  // păstrează ":26:17"
                                }
                                $start_time = date("H:i:s",strtotime($start_time_input));

                                $end_time_input = end($teams_in_stage[$fields[$chipnoIndex]]['stations']);
                                if (str_starts_with($end_time_input, "12")) {
                                    $end_time_input = "00" . substr($end_time_input, 2);  // păstrează ":26:17"
                                }
                                $finish_time = date("H:i:s",strtotime($end_time_input));

                                $start_punch_time_convert = \DateTime::createFromFormat('H:i:s', $start_time);
                                $finish_punch_time_convert = \DateTime::createFromFormat('H:i:s', $finish_time);

                                // Verifica diferenta dintre Start si Total timp
                                // Compute the interval
                                $total_time = $start_punch_time_convert->diff($finish_punch_time_convert);
                                // Format the interval as H:M:S
                                $total_time = $total_time->format('%H:%I:%S');

                            } else {
                                dd('Ceva este gresit la statii in configurare');
                            }

                            // Convert strings to DateTime objects
                            $start = \DateTime::createFromFormat('H:i:s', $start_time);
                            $end = \DateTime::createFromFormat('H:i:s', $finish_time);

                            $startValid = $start && $start->format('H:i:s') === \DateTime::createFromFormat('H:i:s', $start_time)->format('H:i:s');
                            $endValid = $end && $end->format('H:i:s') === \DateTime::createFromFormat('H:i:s', $finish_time)->format('H:i:s');

                            if (($startValid && $endValid) && $teams_in_stage[$fields[$chipnoIndex]]['orienteering_missing'] !== 1) {
                                $teams_in_stage[$fields[$chipnoIndex]]['start_time'] = $start_time;
                                $teams_in_stage[$fields[$chipnoIndex]]['finish_time'] = $finish_time;
                                $teams_in_stage[$fields[$chipnoIndex]]['total_time'] = $total_time;
                            } else {
                                // At least one is invalid
                                $teams_in_stage[$fields[$chipnoIndex]]['start_time'] = "00:00:00";
                                $teams_in_stage[$fields[$chipnoIndex]]['finish_time'] = "00:00:00";
                                $teams_in_stage[$fields[$chipnoIndex]]['total_time'] = "00:00:00";
                            }
                            
                        }
                        else
                        {
                            unset($teams_in_stage[$fields[$chipnoIndex]]);
                            $teams_with_issue[$fields[$chipnoIndex]]['club'] =  'N\A';
                            $teams_with_issue[$fields[$chipnoIndex]]['name'] =  $fields[$surnameIndex];
                            $teams_with_issue[$fields[$chipnoIndex]]['category_name'] =  $fields[$shortIndex];
                            $teams_with_issue[$fields[$chipnoIndex]]['chipno'] =  $fields[$chipnoIndex];
                            $teams_with_issue[$fields[$chipnoIndex]]['start_time'] = "-";
                            $teams_with_issue[$fields[$chipnoIndex]]['finish_time'] = "-";
                            $teams_with_issue[$fields[$chipnoIndex]]['total_time'] = "--"; 
                        }
                        
                } else {
                    //the chipno already exists, send an error.

                    $teams_with_issue[$fields[$chipnoIndex]]['name'] =  $fields[$surnameIndex];
                    $teams_with_issue[$fields[$chipnoIndex]]['category_name'] =  $fields[$shortIndex];
                    $teams_with_issue[$fields[$chipnoIndex]]['chipno'] =  $fields[$chipnoIndex];
                    $teams_with_issue[$fields[$chipnoIndex]]['start_time'] = "-";
                    $teams_with_issue[$fields[$chipnoIndex]]['finish_time'] = "-";
                    $teams_with_issue[$fields[$chipnoIndex]]['total_time'] = "--";      
                    $teams_with_issue[$fields[$chipnoIndex]]['club'] =  'N\A';  
                     
                }

            }

            // dd($teams_with_issue);
            foreach($teams_in_stage as $team_in_stage){
                if(isset($team_in_stage['stations'])){                   

                    if($team_in_stage['orienteering_missing'] == 1){
                        $missed_posts = "POST LIPSA/ORDINE POST";
                        $abandon = 2;
                    } else {
                        $missed_posts = "";
                        $abandon = 0;
                    }
                    Orienteering::where('team_id', $team_in_stage['id'])->where('stage_id', $stageid)->update(
                        [
                            'start_time' => $team_in_stage['start_time'],
                            'finish_time' => $team_in_stage['finish_time'],
                            'total_time' => $team_in_stage['total_time'],
                            'abandon' => $abandon,
                            'missed_posts' => $missed_posts,
                            'order_posts' => json_encode($team_in_stage['stations'])
                        ]);   
                }
            }

            // Sort by count of values
            uasort($teams_in_stage     , function ($a, $b) {
                return count($a) <=> count($b); // ascending order
            });
            
            return view('teams.index_orienteering_chipno',compact('stageid', 'teams_in_stage', 'teams_with_issue'));


        } else {
            $notification = array(
                'success_title' => 'Error',
                'message' => 'No file uploaded.',
                'alert-type' => 'error'
            );
            return redirect()->route('import.index', [$stageid])->with($notification); 
        }


    }

    public function raidmontan_import_sportident($stageid, Request $request)
    {

        if ($request->hasFile('import_file')) {
    
            $path = $request->file('import_file')->getRealPath();
    
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $header = str_getcsv(array_shift($lines), ';');
    
            $dataRows = array_map(function ($line) {
                return str_getcsv($line, ';');
            }, $lines);

            $teams = Team::where('stage_id', $stageid)->with('category')->get();
            $categories = Category::get();

            
            $chipnoIndex = null;
            $surnameIndex = null;
            $shortIndex = null;
            $startPunch = null;
            $finishPunch = null;
            $raid_stations_array = [];
            $raid_montan_stations_stage_array = [];

            foreach($categories as $key => $category){

                $raid_stations_category = RaidmontanStationsStages::where('stage_id', $stageid)->where('category_id', $category->id)->get();
                $first_post = optional($raid_stations_category->first())->post;
                $last_post = optional($raid_stations_category->last())->post;
                foreach($raid_stations_category as $raid_stations){
                    foreach ($header as $index => $column) {
                        if (trim($column) === $raid_stations->cod_start) {
                            $raid_stations_array[$category->name][$index]['start'] = $raid_stations->cod_start;
                        }
                        
                        if ( !empty($raid_stations->cod_finish) && trim($column) === $raid_stations->cod_finish) {
                            $raid_stations_array[$category->name][$index]['finish'] = $raid_stations->cod_finish;
                        }
                        elseif (trim($column) === 'Chipno') {
                            $chipnoIndex = $index;
                        } elseif (trim($column) === 'Surname') {
                            $surnameIndex = $index;
                        } elseif (trim($column) === 'Short') {
                            $shortIndex = $index;
                        } elseif (trim($column) === 'Start punch') {
                            $startPunch = $index;
                        } elseif (trim($column) === 'Finish punch') {
                            $finishPunch = $index;
                        }
                    }
                    
                    // To be used for calculating whether the team stayed longer than allowed in a PA.
                    if (!in_array($raid_stations->post, ["251", "252"])) {
                        $raid_montan_stations_stage_array[$category->name][$raid_stations->post]['arrived'] = $raid_stations->cod_start;
                        $raid_montan_stations_stage_array[$category->name][$raid_stations->post]['go'] = $raid_stations->cod_finish;
                        $raid_montan_stations_stage_array[$category->name][$raid_stations->post]['time'] = $raid_stations->time;
                    }

                }

            };
        
            // Optional: validate that all were found
            if (is_null($chipnoIndex) || is_null($surnameIndex) || is_null($shortIndex)) {
                $notification = array(
                    'success_title' => 'Error',
                    'message' => ' One or more required columns (Chipno, Surname, Short) were not found in the header.',
                    'alert-type' => 'error'
                );
                return redirect()->route('import.index', [$stageid])->with($notification); 
            }


            $teams_in_stage = [];
            $teams_with_issue = [];
            $formatted_time_difference_from_finish_minus_start = [];

            foreach ($dataRows as $index => $fields) {
                if(empty($fields[$chipnoIndex])){
                    $teams_with_issue[$fields[$surnameIndex]]['name'] =  $fields[$surnameIndex];
                    $teams_with_issue[$fields[$surnameIndex]]['category'] =  $fields[$shortIndex];
                    $teams_with_issue[$fields[$surnameIndex]]['chipno'] =  $fields[$chipnoIndex];
                    $teams_with_issue[$fields[$surnameIndex]]['start_time'] = "-";
                    $teams_with_issue[$fields[$surnameIndex]]['finish_time'] = "-";
                    $teams_with_issue[$fields[$surnameIndex]]['total_time'] = "--";
                    continue;
                }

                // $surnameKey = $fields[$surnameIndex] ?? null;
                if (!isset($teams_in_stage[$chipnoIndex])) {

                    // Store the original values before modification
                    $original_start_punch = date("H:i:s",strtotime($fields[$startPunch]));  // Original start time
                    $original_finish_punch = date("H:i:s",strtotime($fields[$finishPunch]));  // Original finish time

                    // Modify the values for further processing
                    if (str_starts_with($original_start_punch, "12")) {
                        $original_start_punch = "00" . substr($original_start_punch, 2);  // Adjust time if it starts with "12"
                    }
                    if (str_starts_with($original_finish_punch, "12")) {
                        $original_finish_punch = "00" . substr($original_finish_punch, 2);  // Adjust time if it starts with "12"
                    }

                    // Convert times to DateTime objects and check if the conversion succeeded
                    $start_punch_from_csv = \DateTime::createFromFormat('H:i:s', $original_start_punch );
                    $finish_punch_from_csv = \DateTime::createFromFormat('H:i:s', $original_finish_punch);

                    $time_difference = $finish_punch_from_csv->diff($start_punch_from_csv);
                    
                    // Check if both conversions succeeded
                    if (!$start_punch_from_csv || !$finish_punch_from_csv) {
                        // Handle invalid time format (for debugging purposes, log or return an error)
                        dd("Invalid time format for start or finish punch: Start Punch: {$fields[$startPunch]}, Finish Punch: {$fields[$finishPunch]}");
                    }

                    // If conversion succeeded, calculate the difference
                    $time_difference = $finish_punch_from_csv->diff($start_punch_from_csv);

                    // Format the difference as HH:MM:SS
                    $formatted_time_difference_from_finish_minus_start[$fields[$chipnoIndex]] = $time_difference->format('%H:%I:%S');

                    
                    // Key exists, do something
                    $teams_in_stage[$fields[$chipnoIndex]]['id'] = 0;
                    $teams_in_stage[$fields[$chipnoIndex]]['name'] = $fields[$surnameIndex];
                    $teams_in_stage[$fields[$chipnoIndex]]['club'] = '';
                    $teams_in_stage[$fields[$chipnoIndex]]['category_name'] = $fields[$shortIndex];
                    $teams_in_stage[$fields[$chipnoIndex]]['category_id'] = $fields[$shortIndex];
                    $teams_in_stage[$fields[$chipnoIndex]]['abandon'] = 0;
                    $teams_in_stage[$fields[$chipnoIndex]]['chipno'] = $fields[$chipnoIndex];
                    $teams_in_stage[$fields[$chipnoIndex]]['stations'] = [];

                    $team_exist = Team::where('chipno', $fields[$chipnoIndex])->with('category')->where('stage_id', $stageid)->first();

                    if( !empty($team_exist) )
                    {
                        $teams_in_stage[$fields[$chipnoIndex]]['id'] = $team_exist->id;
                        $teams_in_stage[$fields[$chipnoIndex]]['club'] = $team_exist->club->name;
                        $teams_in_stage[$fields[$chipnoIndex]]['category_id'] = $team_exist->category_id;


                        foreach($raid_stations_array[$fields[$shortIndex]] as $station_key => $station){

                            
                            if( !isset($fields[$station_key]) ){
                                $notification = array(
                                    'success_title' => 'Error',
                                    'message' => 'Fisierul este incorect, nu sunt setate toate punch-urile corect! Verifica daca nr de posturi de pe categorie corespunde cu cele din excel.',
                                    'alert-type' => 'error'
                                );
                                return redirect()->route('import.index', [$stageid])->with($notification); 
                            }
                            if(in_array($fields[$station_key], ["-----", "00:00:00", ""])) {
                                $teams_in_stage[$fields[$chipnoIndex]]['abandon'] = 2;
                            }

                            //
                            // if(str_starts_with($fields[$station_key], "12")) {
                            //     $fields[$station_key] = "00" . substr($fields[$station_key], 2);  // păstrează ":26:17"
                            // }

                            $fields[$station_key] = date("H:i:s",strtotime($fields[$station_key]));

                            
                            if( !empty($station['start']) && strtolower($station['start']) == "start punch" ){
                                $fields[$station_key] = "00:00:00";
                            }


                            $teams_in_stage[$fields[$chipnoIndex]]['stations'][array_values($station)[0]] = $fields[$station_key];

                        }


                    }

                        
                } else {
                    // Key is missing, do something else
                    
                    $teams_with_issue[$fields[$surnameIndex]]['name'] =  $fields[$surnameIndex];
                    $teams_with_issue[$fields[$surnameIndex]]['category'] =  $fields[$shortIndex];
                    $teams_with_issue[$fields[$surnameIndex]]['chipno'] =  $fields[$chipnoIndex];
                    $teams_with_issue[$fields[$surnameIndex]]['start_time'] = "-";
                    $teams_with_issue[$fields[$surnameIndex]]['finish_time'] = "-";
                    $teams_with_issue[$fields[$surnameIndex]]['total_time'] = "--";
                     
                }

            }

            // dd($teams_in_stage);

            foreach($teams_in_stage as $key => $team_in_stage)
            {

                if(isset($team_in_stage['stations']))
                { 
                    
                    $post_times = [];
                    $post_number = 1;
                    $post_keys = array_keys($team_in_stage['stations']);
                    $post_keys_reset = array_values($team_in_stage['stations']);

                    foreach($post_keys as $key => $name )
                    {
                        if( $key == 0 ){
                            $post_times['251']['arrived'] = [
                                'key' => $name,
                                'time' => date("H:i:s",strtotime($team_in_stage['stations'][$name]))
                            ];
                            continue;
                        }

                    
                        // if the raidmontan is after orienteering else do the standard way.
                        if ($post_keys[0] !== "Start punch" && end($post_keys) === "Finish punch") {

                            if( $key == ( count($post_keys) -1 ) ){                                
                                $post_times['252']['arrived'] = [
                                    'key' => $name,
                                    'time' => $formatted_time_difference_from_finish_minus_start[$team_in_stage['chipno']]
                                ];
                                continue;
                            }
                            
                            
                        } else {
                         
                            if( $key == ( count($post_keys) -1 ) ){
                                $post_times['252']['arrived'] = [
                                    'key' => $name,
                                    'time' => date("H:i:s",strtotime($team_in_stage['stations'][$name]))
                                ];
                                continue;
                            }
                        }

                        if( !isset($post_times[$post_number]['arrived']) ){
                            $post_times[$post_number]['arrived'] = [
                                'key' => $name,
                                'time' => date("H:i:s",strtotime($team_in_stage['stations'][$name]))
                            ];
                            continue;
                        }

                        if( !isset($post_times[$post_number]['go']) ){
                            $post_times[$post_number]['go'] = [
                                'key' => $name,
                                'time' => date("H:i:s",strtotime($team_in_stage['stations'][$name]))
                            ];

                            // If the time spent in PA does not match the defined duration, the extra minutes spent in PA will be deducted from GO.

                            $expectedTime = $raid_montan_stations_stage_array[$team_in_stage['category_name']][$post_number]['time']; // in minutes

                            $arrived = Carbon::createFromFormat('H:i:s', $post_times[$post_number]['arrived']['time']);
                            $go = Carbon::createFromFormat('H:i:s', $post_times[$post_number]['go']['time']);
                            
                            $actualDuration = $arrived->diffInMinutes($go);
                            
                            if ($actualDuration > $expectedTime) {
                                $extraMinutes = $actualDuration - $expectedTime;
                                $newGoTime = $go->subMinutes($extraMinutes);
                                $post_times[$post_number]['go']['time'] = $newGoTime->format('H:i:s');
                            }

                            $post_number++;
                        }
                    }

                    $teams_in_stage[$team_in_stage['chipno']]['raidmontan'] =  $post_times;

                    $missed_posts = "";
                    $abandon = 0;
                    
                    
                }
            }

            // dd($teams_in_stage);
            
            // clean up db
            RaidmontanParticipations::where('stage_id', $stageid)->delete();
            RaidmontanParticipationsEntries::where('stage_id', $stageid)->delete();

            // add abandon to all
            $this->raidmontan_seed_intern($stageid);

            foreach ($teams_in_stage as $team) {
                if (!isset($team['raidmontan'])) {
                    continue;
                }
            
                $raidmontan_participants = RaidmontanParticipations::where('stage_id', $stageid)
                    ->where('team_id', $team['id'])
                    ->first();
            

                if (!$raidmontan_participants) {
                    continue;
                }
            
                $entries = RaidmontanParticipationsEntries::where('stage_id', $stageid)
                    ->where('raidmontan_participations_id', $raidmontan_participants->id)
                    ->where('team_id', $team['id'])
                    ->whereNull('hits')
                    ->get()
                    ->values();
            
                if ($entries->isEmpty()) {
                    continue;
                }
            
                $teamRaid = $team['raidmontan'];
                $entryCount = $entries->count();
            
                // Update first entry with 251 if exists
                if (isset($teamRaid[251]['arrived']['time'])) {
                    $entries[0]->update([
                        'time_start' => $teamRaid[251]['arrived']['time']
                    ]);
                }
            
                // Always try to update last entry with 252 if exists
                if (isset($teamRaid[252]['arrived']['time'])) {
                    $entries[$entryCount - 1]->update([
                        'time_finish' => $teamRaid[252]['arrived']['time']
                    ]);
                }
            
                // If more than 2 entries, update the middle ones
                if ($entryCount > 2) {
                    $middleRaidKeys = array_values(array_filter(array_keys($teamRaid), fn($k) => $k != 251 && $k != 252));
                    $middleEntries = $entries->slice(1, $entryCount - 2)->values();
            
                    foreach ($middleEntries as $i => $entry) {
                        $raidKey = $middleRaidKeys[$i] ?? null;
                        if ($raidKey && isset($teamRaid[$raidKey]['arrived']['time'], $teamRaid[$raidKey]['go']['time'])) {
                            $entry->update([
                                'time_start' => $teamRaid[$raidKey]['arrived']['time'],
                                'time_finish' => $teamRaid[$raidKey]['go']['time']
                            ]);
                        }
                    }
                }

                // Reload updated entries to check time values
                $updatedEntries = RaidmontanParticipationsEntries::where('stage_id', $stageid)
                    ->where('raidmontan_participations_id', $raidmontan_participants->id)
                    ->where('team_id', $team['id'])
                    ->whereNull('hits')
                    ->get();

                    
                $hasInvalidTimes = $updatedEntries->contains(function ($entry) {
                    return $entry->time_start === '00:00:00' && $entry->time_finish === '00:00:00';
                });

                if($hasInvalidTimes == 2){
                    $teams_in_stage[$team['chipno']]['abandon'] = 2;
                } else {
                    $teams_in_stage[$team['chipno']]['abandon'] = 0;
                }

                $raidmontan_participants->update([
                    'abandon' => $hasInvalidTimes ? 2 : 0,
                ]);
            }
            
            // dd($teams_in_stage);

            // Sort by count of values
            uasort($teams_in_stage     , function ($a, $b) {
                return count($a) <=> count($b); // ascending order
            });

            return view('teams.index_raidmontan_chipno',compact('stageid', 'teams_in_stage', 'teams_with_issue'));


        } else {
            $notification = array(
                'success_title' => 'Error',
                'message' => 'No file uploaded.',
                'alert-type' => 'error'
            );
            return redirect()->route('import.index', [$stageid])->with($notification); 
        }


    }


}
