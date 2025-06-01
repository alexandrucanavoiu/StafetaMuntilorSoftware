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
use App\Models\Knowledge;
use App\Models\Cultural;
use App\Models\TeamOrderStart;
use App\Models\Stages;
use App\Models\ClubsStageRankings;
use App\Models\ClubsStageCategoryRankings;
use App\Models\ParticipantsStageRankings;
use DB;
use Illuminate\Support\Facades\Artisan;

class SetupController extends Controller
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

     public function export_db($stageid)
     {
         \Spatie\DbDumper\Databases\MySql::create()
             ->setDbName(env('DB_DATABASE'))
             ->setUserName(env('DB_USERNAME'))
             ->setPassword(env('DB_PASSWORD'))
             ->addExtraOption('--skip-lock-tables')
             ->addExtraOption('--no-tablespaces')
             ->dumpToFile(storage_path("backupDataBASE{$stageid}.sql"));
     
         return response()->download(storage_path("backupDataBASE{$stageid}.sql"));
     }

    public function index($stageid)
    {
        $categories = Category::OrderBy('id', 'ASC')->get();
        $stage = Stages::where('id', $stageid)->first();
        if($stage == null){
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'StageID-ul nu este valid. Incercati sa nu modificati url-urile de mana.',
                'alert-type' => 'error'
            );
            return redirect()->route('error.alert')->with($notification);
        }
        return view('setup.index',compact('categories', 'stageid'));
    }

    public function convert_datetime_timestamp($stageid, Request $request)
    {
        if( $request->ajax() )
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

            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $hour = date('H');
            $minutes = date('i');
            $secounds = date('s');
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('setup.date_time_timestamp', ['year' => $year, 'month' => $month, 'day' => $day, 'hour' => $hour, 'minutes' => $minutes, 'secounds' => $secounds, 'stageid' => $stageid])->render()
                    ] );

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('setup.index')->with($notification);
        }
    }


    public function convert_datetime_timestamp_confirm($stageid, Request $request)
    {
        if( $request->ajax() )
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
                        $rules = [
                            'timestamp_year' => 'required|numeric|max:2025|min:2022',
                            'timestamp_month' => 'required|numeric|max:12|min:01',
                            'timestamp_day' => 'required|numeric|max:31|min:01',
                            'timestamp_hour' => 'required|numeric|max:23|min:00',
                            'timestamp_minutes' => 'required|numeric|max:59|min:00',
                            'timestamp_secounds' => 'required|numeric|max:59|min:00',
                        ];


                        $data = $request->only(['timestamp_year', 'timestamp_month', 'timestamp_day', 'timestamp_hour', 'timestamp_minutes', 'timestamp_secounds']);
                        $validator = Validator::make($data, $rules);

                        if($validator->passes())
                        {

                                    
                            $concatenation = $data['timestamp_year'] . "-" . $data['timestamp_month'] . "-" . $data['timestamp_day']  . " " . $data['timestamp_hour'] . ":" . $data['timestamp_minutes']  . ":" . $data['timestamp_secounds'];
                    
                            $concatenation_output = Carbon::createFromFormat('Y-m-d H:i:s' , $concatenation,'Europe/Bucharest')->timestamp;
                            $concatenation_output_to_datestring = Carbon::createFromTimestamp($concatenation_output)->toDateTimeString(); 
                            
                            return response()->json(['concatenation_output' => $concatenation_output, 'concatenation_output_to_datestring' => $concatenation_output_to_datestring, 'ajax_status_response' => 'success', 'stageid' => $stageid]);

                        } else {
                            return Response::json(['errors' => $validator->errors()]);
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


    public function convert_timestamp_datetime($stageid, Request $request)
    {
        if( $request->ajax() )
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
                    $concatenation_output = Carbon::createFromFormat('Y-m-d H:i:s' , date('Y-m-d H:i:s'),'Europe/Bucharest')->timestamp;
                    $concatenation_output_to_datestring = Carbon::createFromTimestamp($concatenation_output)->toDateTimeString(); 

                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('setup.timestamp_date_time', ['concatenation_output' => $concatenation_output, 'concatenation_output_to_datestring' => $concatenation_output_to_datestring, 'stageid' => $stageid])->render()
                    ] );

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('setup.index')->with($notification);
        }
    }


    public function convert_timestamp_datetime_confirm($stageid, Request $request)
    {
        if( $request->ajax() )
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
                        $rules = [
                            'timestamp' => 'required|numeric',
                        ];


                        $data = $request->only(['timestamp']);
                        $validator = Validator::make($data, $rules);


                        $concatenation_output_to_datestring = Carbon::createFromTimestamp($data['timestamp'])->toDateTimeString(); 
                        $concatenation_output = $data['timestamp'];

                        $carbon_time = Carbon::createFromTimestamp($concatenation_output);
                        $carbon_max_date = Carbon::maxValue();

                        $result = $carbon_time->lt($carbon_max_date);

                        if($result == false){
                            $validator->after(function ($validator) {
                                $validator->errors()->add('form_corruption', 'Verificati unixtime-ul introdus, pare ca nu este corect!');
                            });
                        }

                        if($validator->passes())
                        {
     
                            return response()->json(['concatenation_output' => $concatenation_output, 'concatenation_output_to_datestring' => $concatenation_output_to_datestring, 'ajax_status_response' => 'success', 'stageid' => $stageid]);

                        } else {
                            return Response::json(['errors' => $validator->errors()]);
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


    public function trophy_setup($stageid, Request $request)
    {
        if( $request->ajax() )
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
            $trophy_setup = Stages::where('id', $stageid)->first();
                $ajax_status_response = "success";
                return response()->json( [
                    'ajax_status_response' => $ajax_status_response,
                    'view_content' => view('setup.trophy', ['trophy_setup' => $trophy_setup, 'stageid' => $stageid])->render()
                ] );

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('setup.index', [$stageid, $category->id])->with($notification);
        }
    }


    public function trophy_setup_update($stageid, Request $request)
    {
        if( $request->ajax() )
        {

            $trophy_setup = Stages::where('id', $stageid)->first();
                        $rules = [
                            'name' => 'required|max:255|min:1',
                            'ong' => 'required|max:255|min:1',
                        ];

                        $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                        $request->merge(['created_at' => date('Y-m-d H:i:s')]);

                        $data = $request->only(['name', 'ong', 'stage_id', 'created_at', 'updated_at']);
                        $validator = Validator::make($data, $rules);
                        
                        $stage = Stages::where('id', $stageid)->first();
                        if($stage == null){
                            $validator->after(function ($validator) {
                                $validator->errors()->add('form_corruption', 'StageID-ul nu este corect, incercati sa nu editati in cod.');
                            });
                        }

                        if($validator->passes())
                        {
                                $trophy_setup->update($data);
                                $ajax_redirect_url = route('setup.index', [$stageid]);
                                $ajax_message_response = "Datele au fost actualizate.";
                                $ajax_title_response = "Felicitări!";
                                $ajax_status_response = "success";
                                return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);
                        } else {
                            return Response::json(['errors' => $validator->errors()]);
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


    public function team_order_start($stageid, Request $request)
    {
        if( $request->ajax() )
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
                $categories = Category::orderBy('id', 'ASC')->get();
                $team_order_start = TeamOrderStart::where('stage_id', $stageid)->first();
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('setup.team_order_start', ['categories' => $categories, 'team_order_start' => $team_order_start, 'stageid' => $stageid])->render()
                    ] );

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('setup.index', $category->id)->with($notification);
        }
    }

    public function team_order_start_update($stageid, Request $request)
    {
        if( $request->ajax() )
        {

                        $request->merge(['category_1' => (int)$request->input('category_1')]);
                        $request->merge(['category_2' => (int)$request->input('category_2')]);
                        $request->merge(['category_3' => (int)$request->input('category_3')]);
                        $request->merge(['category_4' => (int)$request->input('category_4')]);
                        $request->merge(['category_5' => (int)$request->input('category_5')]);
                        $request->merge(['category_6' => (int)$request->input('category_6')]);
                        $request->merge(['category_7' => (int)$request->input('category_7')]);


                        $rules = [
                            'category_1' => 'required|numeric|between:1,7',
                            'category_2' => 'required|numeric|between:1,7',
                            'category_3' => 'required|numeric|between:1,7',
                            'category_4' => 'required|numeric|between:1,7',
                            'category_5' => 'required|numeric|between:1,7',
                            'category_6' => 'required|numeric|between:1,7',
                            'category_7' => 'required|numeric|between:1,7',
                            'order_date_start' => 'required|max:255|min:1',
                            'order_start_minutes' => 'required|numeric|between:1,60',
                        ];

                        $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                        $request->merge(['created_at' => date('Y-m-d H:i:s')]);

                        $data = $request->only(['category_1', 'category_2', 'category_3', 'category_4', 'category_5', 'category_6', 'category_7', 'order_date_start', 'order_start_minutes']);
                        $validator = Validator::make($data, $rules);

                        $array_categories[] = $request->input('category_1');
                        $array_categories[] = $request->input('category_2');
                        $array_categories[] = $request->input('category_3');
                        $array_categories[] = $request->input('category_4');
                        $array_categories[] = $request->input('category_5');
                        $array_categories[] = $request->input('category_6');
                        $array_categories[] = $request->input('category_7');

                        $stage = Stages::where('id', $stageid)->first();
                        if($stage == null){
                            $validator->after(function ($validator) {
                                $validator->errors()->add('form_corruption', 'StageID-ul nu este corect, incercati sa nu editati in cod.');
                            });
                        }

                        if(count($array_categories) != count(array_unique($array_categories))){
                            $validator->after(function ($validator) {
                                $validator->errors()->add('form_corruption', 'Verificati ordinea de start pentru categorii, doua sau mai multe categorii au aceeasi ora de start!');
                            });
                        }

                        if(preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/", $request->input('order_date_start')) == 0){
                            $validator->after(function ($validator) {
                                $validator->errors()->add('order_date_start', 'Formuatul nu este corect Ora:Minute:Secunde');
                            });
                        }

                        if($validator->passes())
                        {
                                $categories = Category::orderBy('id', 'ASC')->get();
                                foreach($categories as $category){
                                    $category_id = "category_" . $category->id;
                                    $to_insert = (int)$request->input($category_id);
                                    $category->update(['order_start' => $to_insert]);
                                }
                                
                                $TeamOrderStart = TeamOrderStart::where('stage_id', $stageid)->first();
                                $TeamOrderStart->update(['order_date_start' => $request->input('order_date_start'), 'order_start_minutes' => $request->input('order_start_minutes')]);

                                $ajax_redirect_url = route('setup.index', [$stageid]);
                                $ajax_message_response = "Datele au fost actualizate.";
                                $ajax_title_response = "Felicitări!";
                                $ajax_status_response = "success";
                                return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
                        } else {
                            return Response::json(['errors' => $validator->errors()]);
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

    public function raid_montan_setup($stageid, $id, Request $request)
    {
        if( $request->ajax() )
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

            $category = Category::FindOrFail($id);
            if($category == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Categoria sau Echipa nu exista in baza de date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('setup.index', [$stageid, $category->id])->with($notification);
            } else {
                $raid_montan_setup = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $id)->get();
                if($raid_montan_setup->isEmpty()){
                    $raid_montan_setup = [];
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('setup.raidmontan_edit', ['raid_montan_setup' => $raid_montan_setup, 'category' => $category, 'stageid' => $stageid])->render()
                    ] );
                } else {
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('setup.raidmontan_update', ['raid_montan_setup' => $raid_montan_setup, 'category' => $category, 'stageid' => $stageid])->render()
                    ] );
                }
            }

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('setup.index', [$stageid, $category->id])->with($notification);
        }
    }


    public function raid_montan_setup_update($stageid, $id, Request $request)
    {
        if( $request->ajax() )
        {

            $category = Category::FindOrFail($id);
                if($category == null ) {
                    $notification = array(
                        'success_title' => 'Eroare!!',
                        'message' => 'Categoria nu exista in baza de date!',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('setup.index', [$stageid, $category->id])->with($notification);
                } else {           

                    $stations_pa = array_map(function($val) {
                        return $val === '' ? null : $val;
                    }, json_decode($request->stations_pa, true));
                    
                    $request->merge(['stations_pa' => $stations_pa]);

                    $stations_pfa = array_map(function($val) {
                        return $val === '' ? null : $val;
                    }, json_decode($request->stations_pfa, true));
                    
                    $request->merge(['stations_pfa' => $stations_pfa]);

                    // Now prepare all request data
                    $request->merge([
                        'stations_start' => 0,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]);


                    $rules = [
                        'stations_pa' => 'required|array|min:1|max:30',
                        'stations_pa.*' => 'required|numeric|max:1000|min:1',
                        'stations_pfa' => 'required|array|min:1|max:10000',
                        'stations_pfa.*' => 'required|numeric|max:10000|min:1',
                        'stations_finish' => 'required|numeric|max:10000|min:1',
                    ];     

                    // adaugare text custom pentru erori
                    $attributes = [
                        'stations_finish' => 'Finish',
                    ];;
                    
                    foreach ($request->stations_pa as $index => $val) {
                        $attributes["stations_pa.$index"] = "PA";
                    }
                    
                    foreach ($request->stations_pfa as $index => $val) {
                        $attributes["stations_pfa.$index"] = "PFA";
                    }                 

                    $data = $request->only(['stations_start', 'stations_pa', 'stations_pfa', 'stations_finish', 'missed_posts', 'abandon', 'created_at', 'updated_at', 'team_id']);

                    $validator = Validator::make($request->all(), $rules, [], $attributes);

                    $stage = Stages::where('id', $stageid)->first();
                    if($stage == null){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'StageID-ul nu este corect, incercati sa nu editati in cod.');
                        });
                    }

                    $validator->after(function ($validator) use ($stations_pa, $stations_pfa) {
                        $messages = [];
                    
                        foreach ($stations_pa as $index => $stationpa) {
                            if (!is_numeric($stationpa)) {
                                $messages[] = "PA " . ($index + 1) . ": minutele trebuie să fie numerice.";
                            }
                        }
                    
                        foreach ($stations_pfa as $index => $stationpfa) {
                            if (!is_numeric($stationpfa)) {
                                $messages[] = "PFA " . ($index + 1) . ": punctele trebuie să fie numerice.";
                            }
                        }
                    
                        if (!empty($messages)) {
                            $validator->errors()->add('form_corruption', implode(' ', $messages));
                        }
                    });
                    

                    if($validator->passes())
                    {
                            $raidmontan_stations_start = [];
                            $raidmontan_stations_pa = [];
                            $raidmontan_stations_pfa = [];
                            $raidmontan_stations_finish = [];

                            $raidmontan_stations_start['stage_id'] = $stageid;
                            $raidmontan_stations_start['category_id'] = $category->id;
                            $raidmontan_stations_start['station_type'] = 0;
                            $raidmontan_stations_start['maximum_time'] = null;
                            $raidmontan_stations_start['points'] = null;
                            $raidmontan_stations_start['created_at'] = $data['created_at'];
                            $raidmontan_stations_start['updated_at'] = $data['updated_at'];

                            foreach($stations_pa as $key => $pa){
                                $raidmontan_stations_pa[$key]['stage_id'] = $stageid;
                                $raidmontan_stations_pa[$key]['category_id'] = $category->id;
                                $raidmontan_stations_pa[$key]['station_type'] = 1;
                                $raidmontan_stations_pa[$key]['maximum_time'] = $pa;
                                $raidmontan_stations_pa[$key]['points'] = null;
                                $raidmontan_stations_pa[$key]['created_at'] = $data['created_at'];
                                $raidmontan_stations_pa[$key]['updated_at'] = $data['updated_at'];
                            }

                            foreach($stations_pfa as $key => $pfa){
                                $raidmontan_stations_pfa[$key]['stage_id'] = $stageid;
                                $raidmontan_stations_pfa[$key]['category_id'] = $category->id;
                                $raidmontan_stations_pfa[$key]['station_type'] = 2;
                                $raidmontan_stations_pfa[$key]['maximum_time'] = null;
                                $raidmontan_stations_pfa[$key]['points'] = $pfa;
                                $raidmontan_stations_pfa[$key]['created_at'] = $data['created_at'];
                                $raidmontan_stations_pfa[$key]['updated_at'] = $data['updated_at'];
                            }

                            $raidmontan_stations_finish['stage_id'] = $stageid;
                            $raidmontan_stations_finish['category_id'] = $category->id;
                            $raidmontan_stations_finish['station_type'] = 3;
                            $raidmontan_stations_finish['maximum_time'] = $data['stations_finish'];
                            $raidmontan_stations_finish['points'] = null;
                            $raidmontan_stations_finish['created_at'] = $data['created_at'];
                            $raidmontan_stations_finish['updated_at'] = $data['updated_at'];

                            // dd($raidmontan_stations_start);
                            // dd($raidmontan_stations_pa);
                            // dd($raidmontan_stations_pfa);
                            // dd($raidmontan_stations_finish);
                            $count_raidmontan_stations_pa = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $category->id)->where('station_type', 1)->count();
                            $count_raidmontan_stations_pfa = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $category->id)->where('station_type', 2)->count();
                            
                            if(count($raidmontan_stations_pa) == $count_raidmontan_stations_pa && $count_raidmontan_stations_pfa == count($raidmontan_stations_pfa)){
                                
                                $raidmontan_start = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $category->id)->where('station_type', 0)->first();
                                $raidmontan_finish = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $category->id)->where('station_type', 3)->first();

                                $raidmontan_pa = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $category->id)->where('station_type', 1)->get();
                                $raidmontan_pfa = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $category->id)->where('station_type', 2)->get();

                                $raidmontan_start->update($raidmontan_stations_start);

                                foreach($raidmontan_pa as $key => $pa){
                                    $raid_pa = RaidmontanStations::findOrFail($pa->id);
                                    $raid_pa->update($raidmontan_stations_pa[$key]);
                                }

                                foreach($raidmontan_pfa as $key => $pfa){
                                    $raid_pfa = RaidmontanStations::findOrFail($pfa->id);
                                    $raid_pfa->update($raidmontan_stations_pfa[$key]);
                                }

                                $raidmontan_finish->update($raidmontan_stations_finish);      
                            } else {
                            RaidmontanStationsStages::where('stage_id', $stageid)->where('category_id', $id)->delete();
                            RaidmontanStations::where('stage_id', $stageid)->where('category_id', $category->id)->delete();

                            // clean up Raid Montan teams records
                            $team = Team::with('raidmontan_participations')->with('raidmontan_participations_entries')->where('stage_id', $stageid)->where('category_id', $category->id)->get();
                            foreach($team as $value){
                                
                                if($value->raidmontan_participations !== null){
                                    RaidmontanParticipations::where('id', $value->raidmontan_participations->id)->delete();
                                }
                                
                                if($value->raidmontan_participations_entries !== null){
                                    foreach($value->raidmontan_participations_entries as $raidmontan_participations_entries){
                                        $raidmontan_participations_entries->delete();
                                    }
                                }

                            }


                            RaidmontanStations::insert($raidmontan_stations_start);
                            RaidmontanStations::insert($raidmontan_stations_pa);
                            RaidmontanStations::insert($raidmontan_stations_pfa);
                            RaidmontanStations::insert($raidmontan_stations_finish);                                
                            }


                            $ajax_redirect_url = route('setup.index', [$stageid, $category->id]);
                            $ajax_message_response = "Datele au fost adaugate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);
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


    public function raid_montan_setup_stages($stageid, $id, Request $request)
    {
        if( $request->ajax() )
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

            $category = Category::FindOrFail($id);
            if($category == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Categoria sau Echipa nu exista in baza de date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('setup.index', [$stageid, $category->id])->with($notification);
            } else {
                
                $setup_raid_montan = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $category->id)->get();
                if($setup_raid_montan->isEmpty()){
                    $ajax_message_response = "Nu puteti configura statiile pana cand nu configurati traseul de Raid Montan cu timpii!";
                    $ajax_title_response = "Eroare!";
                    $ajax_status_response = "error";
                    return response()->json(['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);
                } else  {
                    $raid_montan_setup_stages = RaidmontanStationsStages::where('stage_id', $stageid)->where('category_id', $id)->get();
                    $raid_montan_setup = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $id)->where('station_type', 1)->get();
                    if($raid_montan_setup_stages->isEmpty() == true){
                        $ajax_status_response = "success";
                        return response()->json( [
                            'ajax_status_response' => $ajax_status_response,
                            'view_content' => view('setup.raidmontan_stages', ['raid_montan_setup' => $raid_montan_setup, 'raid_montan_setup_stages' => $raid_montan_setup_stages, 'category' => $category, 'stageid' => $stageid])->render()
                        ] );
                    } else {
                        $ajax_status_response = "success";
                        return response()->json( [
                            'ajax_status_response' => $ajax_status_response,
                            'view_content' => view('setup.raidmontan_stages_update', ['raid_montan_setup' => $raid_montan_setup, 'raid_montan_setup_stages' => $raid_montan_setup_stages, 'category' => $category, 'stageid' => $stageid])->render()
                        ] );
                    }
                }
            }

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('setup.index', [$stageid, $category->id])->with($notification);
        }
    }

    public function raid_montan_setup_stages_update($stageid, $id, Request $request)
    {
        if( $request->ajax() )
        {
     
            $category = Category::FindOrFail($id);

            $stage = Stages::where('id', $stageid)->first();
            if($stage == null){
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'StageID-ul nu este valid. Incercati sa nu modificati url-urile de mana.',
                    'alert-type' => 'error'
                );
                return redirect()->route('error.alert')->with($notification);
            }

            if($category == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Categoria sau Echipa nu exista in baza de date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('setup.index', [$stageid, $category->id])->with($notification);
            } else {

                $setup_raid_montan = RaidmontanStations::where('stage_id', $stageid)->where('category_id', $category->id)->get();
                if($setup_raid_montan->isEmpty()){
                    $ajax_message_response = "Nu puteti configura statiile pana cand nu configurati traseul de Raid Montan cu timpii!";
                    $ajax_title_response = "Eroare!";
                    $ajax_status_response = "error";
                    return response()->json(['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stage_id' => $stageid], 200);
                } else  {

                    $post = json_decode($request->post, true);
                    $request->merge(['post' => $post]);

                    $rules = [
                        'start_251' => 'required|string',
                        'finish_252' => 'required|string',
                        'post' => 'required|array',
                        'post.*.arrived' => 'required|string',
                        'post.*.go' => 'required|string',
                        'post.*.time' => 'required|numeric',
                    ];


                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['created_at' => date('Y-m-d H:i:s')]);

                    $data = $request->only(['start_251', 'post', 'finish_252', 'created_at', 'updated_at']);


                    // adaugare text custom pentru erori
                    $attributes = [
                        'start_251' => 'Codul de start',
                        'finish_252' => 'Codul de finish',
                    ];
                    
                    foreach ($post as $index => $values) {
                        $attributes["post.$index.time"] = "Timpul de pauză pentru PA $index";
                        $attributes["post.$index.arrived"] = "Cod sosire pentru PA $index";
                        $attributes["post.$index.go"] = "Cod plecare pentru PA $index";
                    }
                    
             
                    $validator = Validator::make($data, $rules, [], $attributes);

                    if($validator->passes())
                    {
                        
                        $stations_start['stage_id'] = $stageid;
                        $stations_start['category_id'] = $category->id;
                        $stations_start['post'] = 251;
                        $stations_start['cod_start'] = trim($data['start_251']);
                        $stations_start['cod_finish'] = null;
                        $stations_start['time'] = null;
                        $stations_start['created_at'] = $data['created_at'];
                        $stations_start['updated_at'] = $data['updated_at'];

                        $stations_finish['stage_id'] = $stageid;
                        $stations_finish['category_id'] = $category->id;
                        $stations_finish['post'] = 252;
                        $stations_finish['cod_start'] = trim($data['finish_252']);
                        $stations_finish['cod_finish'] = null;
                        $stations_finish['time'] = null;
                        $stations_finish['created_at'] = $data['created_at'];
                        $stations_finish['updated_at'] = $data['updated_at'];

                        $stations = [];

                        foreach ($post as $key => $value) {
                            $stations[$key]['stage_id'] = $stageid;
                            $stations[$key]['category_id'] = $category->id;
                            $stations[$key]['post'] = $key;
                            $stations[$key]['cod_start'] = trim($value['arrived']);
                            $stations[$key]['cod_finish'] = trim($value['go']);
                            $stations[$key]['time'] = $value['time'];
                            $stations[$key]['created_at'] = $data['created_at'];
                            $stations[$key]['updated_at'] = $data['updated_at'];
                        }

                        RaidmontanStationsStages::where('stage_id', $stageid)->where('category_id', $id)->delete();
                        RaidmontanStationsStages::insert($stations_start);
                        RaidmontanStationsStages::insert($stations);
                        RaidmontanStationsStages::insert($stations_finish);

                        $ajax_redirect_url = route('setup.index', [$stageid, $category->id]);
                        $ajax_message_response = "Datele au fost adaugate.";
                        $ajax_title_response = "Felicitări!";
                        $ajax_status_response = "success";
                        return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);
                    } else {
                        return Response::json(['errors' => $validator->errors()]);
                    }

                }
            }

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('setup.index', [$stageid, $category->id])->with($notification);
        }
    }

    public function orienteering_setup_stages($stageid, $id, Request $request)
    {
        if( $request->ajax() )
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

            $category = Category::FindOrFail($id);
            if($category == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Categoria sau Echipa nu exista in baza de date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('setup.index', [$stageid, $category->id])->with($notification);
            } else {

                    $orienteering_setup_stages = OrienteeringStationsStages::where('stage_id', $stageid)->where('category_id', $id)->get();
                    if($orienteering_setup_stages->isEmpty() == true){
                        $ajax_status_response = "success";
                        return response()->json( [
                            'ajax_status_response' => $ajax_status_response,
                            'view_content' => view('setup.orienteering_stages', ['orienteering_setup_stages' => $orienteering_setup_stages, 'category' => $category, 'stageid' => $stageid])->render()
                        ] );
                    } else {
                        $ajax_status_response = "success";
                        return response()->json( [
                            'ajax_status_response' => $ajax_status_response,
                            'view_content' => view('setup.orienteering_stages_update', ['orienteering_setup_stages' => $orienteering_setup_stages, 'category' => $category, 'stageid' => $stageid])->render()
                        ] );
                    }
            }

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('setup.index', [$stageid, $category->id])->with($notification);
        }
    }

    public function orienteering_setup_stages_update($stageid, $id, Request $request)
    {
        if( $request->ajax() )
        {

            $stage = Stages::where('id', $stageid)->first();
            $category = Category::FindOrFail($id);
                if($category == null ) {
                    $notification = array(
                        'success_title' => 'Eroare!!',
                        'message' => 'Categoria nu exista in baza de date!',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('setup.index', [$stage->id, $category->id])->with($notification);
                } else {

                    $rules = [
                        'post' => 'required|array|min:1|max:30',
                        'post.*' => 'required|max:255|min:1',
                    ];

                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['created_at' => date('Y-m-d H:i:s')]);

                    $post = [];
                    if(!empty($request->input('post'))){
                        $post = explode(',', $request->input('post'));
                        $request->merge(['post' => $post]);
                    }

                    $data = $request->only(['post', 'created_at', 'updated_at']);
                    $validator = Validator::make($data, $rules);

                    if($stage == null){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'StageID-ul nu este corect, incercati sa nu editati in cod.');
                        });
                    }

                    if(count($post) == 0){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'Verificati datele introduse sunt corecte!');
                        });
                    }

                    if($validator->passes())
                    {

                        $stages_array = [];
                        foreach($post as $key => $stage){
                            $stages_array[$key]['stage_id'] =  $stageid;
                            $stages_array[$key]['category_id'] =  $category->id;
                            $stages_array[$key]['post'] =  $stage;
                            $stages_array[$key]['created_at'] =  $data['created_at'];
                            $stages_array[$key]['updated_at'] =  $data['updated_at'];
                        }

                        OrienteeringStationsStages::where('stage_id', $stageid)->where('category_id', $id)->delete();
                        OrienteeringStationsStages::insert($stages_array);

                            $ajax_redirect_url = route('setup.index', [$stageid, $category->id]);
                            $ajax_message_response = "Datele au fost adaugate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);
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

    public function destroy($stageid, Request $request)
    {
        if( $request->ajax() )
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

            if($request->input('delete_clubs') == "true"){
                $data['delete_clubs'] = true;
            } else {
                $data['delete_clubs'] = false;
            }

            if($request->input('delete_teams') == "true"){
                $data['delete_teams'] = true;
            } else {
                $data['delete_teams'] = false;
            }

            if($request->input('delete_config_raid_montan') == "true"){
                $data['delete_config_raid_montan'] = true;
            } else {
                $data['delete_config_raid_montan'] = false;
            }

            if($request->input('delete_config_orienteering') == "true"){
                $data['delete_config_orienteering'] = true;
            } else {
                $data['delete_config_orienteering'] = false;
            }

            if($request->input('delete_config_knowledge') == "true"){
                $data['delete_config_knowledge'] = true;
            } else {
                $data['delete_config_knowledge'] = false;
            }

            if($request->input('delete_rezults_raid_montan') == "true"){
                $data['delete_rezults_raid_montan'] = true;
            } else {
                $data['delete_rezults_raid_montan'] = false;
            }

            if($request->input('delete_rezults_orienteering') == "true"){
                $data['delete_rezults_orienteering'] = true;
            } else {
                $data['delete_rezults_orienteering'] = false;
            }

            if($request->input('delete_rezults_knowledge') == "true"){
                $data['delete_rezults_knowledge'] = true;
            } else {
                $data['delete_rezults_knowledge'] = false;
            }

            if($request->input('delete_rezults_cultural') == "true"){
                $data['delete_rezults_cultural'] = true;
            } else {
                $data['delete_rezults_cultural'] = false;
            }

            $rules = [
                'delete_clubs' => 'required|boolean',
                'delete_teams' => 'required|boolean',
                'delete_config_raid_montan' => 'required|boolean',
                'delete_config_orienteering' => 'required|boolean',
                'delete_rezults_raid_montan' => 'required|boolean',
                'delete_rezults_orienteering' => 'required|boolean',
                'delete_rezults_knowledge' => 'required|boolean',
                'delete_rezults_cultural' => 'required|boolean',
            ];

            $validator = Validator::make($data, $rules);
            
            
            if($validator->passes())
            {

                if($data['delete_clubs'] == true){
                    Team::where('stage_id', $stageid)->delete();
                    RaidmontanParticipations::where('stage_id', $stageid)->delete();
                    RaidmontanParticipationsEntries::where('stage_id', $stageid)->delete();
                    Orienteering::where('stage_id', $stageid)->delete();
                    Knowledge::where('stage_id', $stageid)->delete();
                    Cultural::where('stage_id', $stageid)->delete();
                }

                if($data['delete_teams'] == true){
                    Team::where('stage_id', $stageid)->delete();
                    RaidmontanParticipations::where('stage_id', $stageid)->delete();
                    RaidmontanParticipationsEntries::where('stage_id', $stageid)->delete();
                    Orienteering::where('stage_id', $stageid)->delete();
                    Knowledge::where('stage_id', $stageid)->delete();
                }

                if($data['delete_config_raid_montan'] == true){
                    RaidmontanStations::where('stage_id', $stageid)->delete();
                    RaidmontanStationsStages::where('stage_id', $stageid)->delete();
                    RaidmontanParticipations::where('stage_id', $stageid)->delete();
                    RaidmontanParticipationsEntries::where('stage_id', $stageid)->delete();
                }

                if($data['delete_config_orienteering'] == true){
                    OrienteeringStationsStages::where('stage_id', $stageid)->delete();
                }

                if($data['delete_rezults_raid_montan'] == true){
                    RaidmontanParticipations::where('stage_id', $stageid)->delete();
                    RaidmontanParticipationsEntries::where('stage_id', $stageid)->delete();
                }

                if($data['delete_rezults_orienteering'] == true){
                    Orienteering::where('stage_id', $stageid)->delete();
                }

                if($data['delete_rezults_knowledge'] == true){
                    Knowledge::where('stage_id', $stageid)->delete();
                }

                if($data['delete_rezults_cultural'] == true){
                    Cultural::where('stage_id', $stageid)->delete();
                }

                ClubsStageRankings::where('stage_id', $stageid)->delete();
                ParticipantsStageRankings::where('stage_id', $stageid)->delete();
                ClubsStageCategoryRankings::where('stage_id', $stageid)->delete();
                ClubsStageRankings::where('stage_id', $stageid)->delete();

                $ajax_message_response = "Datele au fost sterse.";
                $ajax_title_response = "Felicitări!";
                $ajax_status_response = "success";
                return response()->json(['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
                
            
            } else {
                return Response::json(['errors' => $validator->errors()]);
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

    public function demo_data_1($stageid)
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
        Club::where('stage_id', $stageid)->delete();
        Team::where('stage_id', $stageid)->delete();
        RaidmontanParticipations::where('stage_id', $stageid)->delete();
        RaidmontanParticipationsEntries::where('stage_id', $stageid)->delete();
        Orienteering::where('stage_id', $stageid)->delete();
        Knowledge::where('stage_id', $stageid)->delete();
        Cultural::where('stage_id', $stageid)->delete();
        RaidmontanStations::where('stage_id', $stageid)->delete();
        RaidmontanStationsStages::where('stage_id', $stageid)->delete();
        DB::unprepared(file_get_contents('db_demo/demo_stafeta_100_echipe_31_cluburi.sql'));
        $notification = array(
            'success_title' => 'Success!!',
            'message' => 'Datele DEMO au fost importate',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }

    public function demo_data_2($stageid)
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
        Club::where('stage_id', $stageid)->delete();
        Team::where('stage_id', $stageid)->delete();
        RaidmontanParticipations::where('stage_id', $stageid)->delete();
        RaidmontanParticipationsEntries::where('stage_id', $stageid)->delete();
        Orienteering::where('stage_id', $stageid)->delete();
        Knowledge::where('stage_id', $stageid)->delete();
        Cultural::where('stage_id', $stageid)->delete();
        RaidmontanStations::where('stage_id', $stageid)->delete();
        RaidmontanStationsStages::where('stage_id', $stageid)->delete();
        DB::unprepared(file_get_contents('db_demo/demo_stafeta_90_echipe_24_cluburi.sql'));
        $notification = array(
            'success_title' => 'Success!!',
            'message' => 'Datele DEMO au fost importate',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }

    public function convert_raid_to_ultra($stageid)
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

        $teams = Team::where('stage_id', $stageid)->with('uuid_raid')->with('raidmontan_participations')->with('raidmontan_participations_entries')->get();

        foreach($teams as $key => $team){

            $raidmontan_stations_stages = RaidmontanStationsStages::where('stage_id', $stageid)->where('category_id', $team->category_id)->whereNotIn('post', [251,252])->get();
            $stage_result = [];
            foreach($raidmontan_stations_stages as $stage){
                $stage_result[] = $stage->post;
            }            

            if($team->raidmontan_participations->abandon == 0){
                echo "Card: " . $team->uuid_raid->name ."<br/>";
                
                $raid_montan_stations = "";
                $raid_montan_stations_pa = 0;
                foreach($team->raidmontan_participations_entries as $key2 => $raidmontan_participations_entries){
                    if($raidmontan_participations_entries->raidmontan_stations_station_type == 0){
                        $val = "251," . strtotime($raidmontan_participations_entries->time_start) . ",";
                        $raid_montan_stations .= $val;
                    }
                    elseif($raidmontan_participations_entries->raidmontan_stations_station_type == 1){
                        $raid_montan_stations .= $stage_result[$raid_montan_stations_pa] . "," . strtotime($raidmontan_participations_entries->time_start) . ",";
                        $raid_montan_stations .= $stage_result[$raid_montan_stations_pa] . "," . strtotime($raidmontan_participations_entries->time_finish) . ",";
                        $raid_montan_stations_pa++;
                    }
                    elseif($raidmontan_participations_entries->raidmontan_stations_station_type == 3){
                        $raid_montan_stations .= "252," . strtotime($raidmontan_participations_entries->time_finish) . ",%";
                    } else {
                        continue;
                    }

                }

                echo $raid_montan_stations;
                echo "<br/>";
                echo "<br/>";

            }

        }

    }

    public function convert_orienteering_to_ultra($stageid)
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

        $teams = Team::where('stage_id', $stageid)->with('uuid_orienteering')->with('orienteering')->get();

        foreach($teams as $key => $team){
            $orienteering_stations_stages = OrienteeringStationsStages::where('stage_id', $stageid)->where('category_id', $team->category_id)->whereNotIn('post', [251,252])->get();
            $stage_result = [];
            foreach($orienteering_stations_stages as $stage){
                $stage_result[] = $stage->post;
            }

            if($team->orienteering->abandon == 0){

                $orienteering_stations = "";
                $orienteering_stations_pa = 0;

                echo "Card: " . $team->uuid_orienteering->name ."<br/>";
                $start = strtotime($team->orienteering->start_time);
                $finish = strtotime($team->orienteering->finish_time);

                $val = "251," . $start . ",";
                $orienteering_stations .= $val;

                foreach($stage_result as $stage){

                    $val = $stage . "," . $start + 60 . ",";
                    $orienteering_stations .= $val;

                }

                $val = "252," . $finish . ",%";
                $orienteering_stations .= $val;

                echo $orienteering_stations;
                echo "<br/>";
                echo "<br/>";

            }

        }

    }

}
