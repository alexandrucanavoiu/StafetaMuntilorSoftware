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
use App\Models\OrganizerStage;
use App\Models\Knowledge;
use App\Models\Cultural;
use App\Models\TeamOrderStart;
use DB;

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
    public function index()
    {
        $categories = Category::OrderBy('id', 'ASC')->get();
        return view('setup.index',compact('categories'));
    }

    public function trophy_setup(Request $request)
    {
        if( $request->ajax() )
        {
                $trophy_setup = OrganizerStage::where('id', 1)->first();
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('setup.trophy', ['trophy_setup' => $trophy_setup])->render()
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

    public function trophy_setup_update(Request $request)
    {
        if( $request->ajax() )
        {
            $trophy_setup = OrganizerStage::where('id', 1)->first();
                        $rules = [
                            'name_stage' => 'required|max:255|min:1',
                            'name_organizer' => 'required|max:255|min:1',
                            'stage_number' => 'required|numeric|max:255|min:0'
                        ];

                        $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                        $request->merge(['created_at' => date('Y-m-d H:i:s')]);

                        $data = $request->only(['name_stage', 'name_organizer', 'stage_number', 'created_at', 'updated_at']);
                        $validator = Validator::make($data, $rules);

                        if($validator->passes())
                        {
                                $trophy_setup->update($data);
                                $ajax_redirect_url = route('setup.index');
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


    public function team_order_start(Request $request)
    {
        if( $request->ajax() )
        {
                $categories = Category::orderBy('id', 'ASC')->get();
                $team_order_start = TeamOrderStart::where('id', 1)->first();
                
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('setup.team_order_start', ['categories' => $categories, 'team_order_start' => $team_order_start])->render()
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

    public function team_order_start_update(Request $request)
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

                                
                                $TeamOrderStart = TeamOrderStart::where('id', 1)->first();
                                $TeamOrderStart->update(['order_date_start' => $request->input('order_date_start'), 'order_start_minutes' => $request->input('order_start_minutes')]);

                                $ajax_redirect_url = route('setup.index');
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

    public function raid_montan_setup($id, Request $request)
    {
        if( $request->ajax() )
        {
            $category = Category::FindOrFail($id);
            if($category == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Categoria sau Echipa nu exista in baza de date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('setup.index', $category->id)->with($notification);
            } else {
                $raid_montan_setup = RaidmontanStations::where('category_id', $id)->get();
                if($raid_montan_setup->isEmpty()){
                    $raid_montan_setup = [];
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('setup.raidmontan_edit', ['raid_montan_setup' => $raid_montan_setup, 'category' => $category])->render()
                    ] );
                } else {
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('setup.raidmontan_update', ['raid_montan_setup' => $raid_montan_setup, 'category' => $category])->render()
                    ] );
                }
            }

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('setup.index', $category->id)->with($notification);
        }
    }


    public function raid_montan_setup_update($id, Request $request)

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
                    return redirect()->route('setup.index', $category->id)->with($notification);
                } else {

                    $rules = [
                        'stations_pa' => 'required|array|min:1|max:30',
                        'stations_pa.*' => 'required|numeric|max:1000|min:1',
                        'stations_pfa' => 'required|array|min:1|max:10000',
                        'stations_pfa.*' => 'required|numeric|max:10000|min:1',
                        'stations_finish' => 'required|numeric|max:10000|min:1',
                    ];

                    $request->merge(['stations_start' => 0]);
                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['created_at' => date('Y-m-d H:i:s')]);

                    // create array for PA stations
                    if(!empty($request->input('stations_pa'))){
                        $stations_pa = explode(',', $request->input('stations_pa'));
                        $request->merge(['stations_pa' => $stations_pa]);
                    }

                    // create array for PFA stations
                    if(!empty($request->input('stations_pfa'))){
                        $stations_pfa = explode(',', $request->input('stations_pfa'));
                        $request->merge(['stations_pfa' => $stations_pfa]);
                    }

                    $data = $request->only(['stations_start', 'stations_pa', 'stations_pfa', 'stations_finish', 'missed_posts', 'abandon', 'created_at', 'updated_at', 'team_id']);
                    $validator = Validator::make($data, $rules);

                    foreach($stations_pa as $stationpa){
                        if(is_numeric($stationpa) == false){
                            $validator->after(function ($validator) {
                                $validator->errors()->add('form_corruption', 'Verificati datele introduse la PA-uri, minutele trebuie sa fie in format numeric!');
                            });
                        }
                    }

                    foreach($stations_pfa as $stationpfa){
                        if(is_numeric($stationpfa) == false){
                            $validator->after(function ($validator) {
                                $validator->errors()->add('form_corruption', 'Verificati datele introduse la PFA-uri, punctele trebuie sa fie in format numeric!');
                            });
                        }
                    }

                    if($validator->passes())
                    {


                            $raidmontan_stations_start = [];
                            $raidmontan_stations_pa = [];
                            $raidmontan_stations_pfa = [];
                            $raidmontan_stations_finish = [];

                            $raidmontan_stations_start['category_id'] = $category->id;
                            $raidmontan_stations_start['station_type'] = 0;
                            $raidmontan_stations_start['maximum_time'] = null;
                            $raidmontan_stations_start['points'] = null;
                            $raidmontan_stations_start['created_at'] = $data['created_at'];
                            $raidmontan_stations_start['updated_at'] = $data['updated_at'];

                            foreach($stations_pa as $key => $pa){
                                $raidmontan_stations_pa[$key]['category_id'] = $category->id;
                                $raidmontan_stations_pa[$key]['station_type'] = 1;
                                $raidmontan_stations_pa[$key]['maximum_time'] = $pa;
                                $raidmontan_stations_pa[$key]['points'] = null;
                                $raidmontan_stations_pa[$key]['created_at'] = $data['created_at'];
                                $raidmontan_stations_pa[$key]['updated_at'] = $data['updated_at'];
                            }

                            foreach($stations_pfa as $key => $pfa){
                                $raidmontan_stations_pfa[$key]['category_id'] = $category->id;
                                $raidmontan_stations_pfa[$key]['station_type'] = 2;
                                $raidmontan_stations_pfa[$key]['maximum_time'] = null;
                                $raidmontan_stations_pfa[$key]['points'] = $pfa;
                                $raidmontan_stations_pfa[$key]['created_at'] = $data['created_at'];
                                $raidmontan_stations_pfa[$key]['updated_at'] = $data['updated_at'];
                            }

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
                            $count_raidmontan_stations_pa = RaidmontanStations::where('category_id', $category->id)->where('station_type', 1)->count();
                            $count_raidmontan_stations_pfa = RaidmontanStations::where('category_id', $category->id)->where('station_type', 2)->count();
                            
                            if(count($raidmontan_stations_pa) == $count_raidmontan_stations_pa && $count_raidmontan_stations_pfa == count($raidmontan_stations_pfa)){
                                
                                $raidmontan_start = RaidmontanStations::where('category_id', $category->id)->where('station_type', 0)->first();
                                $raidmontan_finish = RaidmontanStations::where('category_id', $category->id)->where('station_type', 3)->first();

                                $raidmontan_pa = RaidmontanStations::where('category_id', $category->id)->where('station_type', 1)->get();
                                $raidmontan_pfa = RaidmontanStations::where('category_id', $category->id)->where('station_type', 2)->get();

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
                            RaidmontanStationsStages::where('category_id', $id)->delete();
                            RaidmontanStations::where('category_id', $category->id)->delete();

                            // clean up Raid Montan teams records
                            $team = Team::with('raidmontan_participations')->with('raidmontan_participations_entries')->where('category_id', $category->id)->get();
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


                            $ajax_redirect_url = route('setup.index', $category->id);
                            $ajax_message_response = "Datele au fost adaugate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
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


    public function raid_montan_setup_stages($id, Request $request)
    {
        if( $request->ajax() )
        {
            $category = Category::FindOrFail($id);
            if($category == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Categoria sau Echipa nu exista in baza de date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('setup.index', $category->id)->with($notification);
            } else {

                $setup_raid_montan = RaidmontanStations::where('category_id', $category->id)->get();
                if($setup_raid_montan->isEmpty()){
                    $ajax_message_response = "Nu puteti configura statiile pana cand nu configurati traseul de Raid Montan cu timpii!";
                    $ajax_title_response = "Eroare!";
                    $ajax_status_response = "error";
                    return response()->json(['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
                } else  {
                    $raid_montan_setup_stages = RaidmontanStationsStages::where('category_id', $id)->get();
                    $raid_montan_setup = RaidmontanStations::where('category_id', $id)->where('station_type', 1)->get();
                    if($raid_montan_setup_stages->isEmpty() == true){
                        $ajax_status_response = "success";
                        return response()->json( [
                            'ajax_status_response' => $ajax_status_response,
                            'view_content' => view('setup.raidmontan_stages', ['raid_montan_setup' => $raid_montan_setup, 'raid_montan_setup_stages' => $raid_montan_setup_stages, 'category' => $category])->render()
                        ] );
                    } else {
                        $ajax_status_response = "success";
                        return response()->json( [
                            'ajax_status_response' => $ajax_status_response,
                            'view_content' => view('setup.raidmontan_stages_update', ['raid_montan_setup' => $raid_montan_setup, 'raid_montan_setup_stages' => $raid_montan_setup_stages, 'category' => $category])->render()
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
            return redirect()->route('setup.index', $category->id)->with($notification);
        }
    }


    public function raid_montan_setup_stages_update($id, Request $request)
    {
        if( $request->ajax() )
        {
            $category = Category::FindOrFail($id);
            if($category == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Categoria sau Echipa nu exista in baza de date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('setup.index', $category->id)->with($notification);
            } else {

                $setup_raid_montan = RaidmontanStations::where('category_id', $category->id)->get();
                if($setup_raid_montan->isEmpty()){
                    $ajax_message_response = "Nu puteti configura statiile pana cand nu configurati traseul de Raid Montan cu timpii!";
                    $ajax_title_response = "Eroare!";
                    $ajax_status_response = "error";
                    return response()->json(['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
                } else  {


                    $rules = [
                        'time' => 'required|array|min:1|max:30',
                        'time.*' => 'required|max:255|min:1',
                        'post' => 'required|array|min:1|max:30',
                        'post.*' => 'required|max:255|min:1',
                    ];

                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['created_at' => date('Y-m-d H:i:s')]);

                    $time = [];
                    if(!empty($request->input('time'))){
                        $time = explode(',', $request->input('time'));
                        $request->merge(['time' => $time]);
                    }

                    $post = [];
                    if(!empty($request->input('post'))){
                        $post = explode(',', $request->input('post'));
                        $request->merge(['post' => $post]);
                    }

                    $data = $request->only(['post', 'time', 'created_at', 'updated_at']);
                    $validator = Validator::make($data, $rules);

                    if(count($time) == 0){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'Verificati datele introduse la minute de pauza, minutele trebuie sa fie in format numeric!');
                        });
                    } else {
                        foreach($time as $t){
                            if(is_numeric($t) == false){
                                $validator->after(function ($validator) {
                                    $validator->errors()->add('form_corruption', 'Verificati datele introduse la minute de pauza, minutele trebuie sa fie in format numeric!');
                                });
                            }
                        }
                    }

                    if(count($post) == 0){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'Verificati datele introduse la PA-uri, cod statie trebuie sa fie in format numeric!');
                        });
                    } else {
                        foreach($post as $t){
                            if(is_numeric($t) == false){
                                $validator->after(function ($validator) {
                                    $validator->errors()->add('form_corruption', 'Verificati datele introduse la PA-uri, cod statie trebuie sa fie in format numeric!');
                                });
                            }
                        }
                    }

                    if($validator->passes())
                    {

                        $stations = [];
                        $number = 0;


                        foreach($data['time'] as $key => $time) {
                            $stations[$key]['category_id'] = $category->id;
                            $stations[$key]['post'] = $post[$key];
                            $stations[$key]['time'] = $time;
                            $stations[$key]['created_at'] = $data['created_at'];
                            $stations[$key]['updated_at'] = $data['updated_at'];
                        }

                        $stations_start['category_id'] = $category->id;
                        $stations_start['post'] = 251;
                        $stations_start['time'] = null;
                        $stations_start['created_at'] = $data['created_at'];
                        $stations_start['updated_at'] = $data['updated_at'];

                        $stations_finish['category_id'] = $category->id;
                        $stations_finish['post'] = 252;
                        $stations_finish['time'] = null;
                        $stations_finish['created_at'] = $data['created_at'];
                        $stations_finish['updated_at'] = $data['updated_at'];

                        RaidmontanStationsStages::where('category_id', $id)->delete();
                        RaidmontanStationsStages::insert($stations_start);
                        RaidmontanStationsStages::insert($stations);
                        RaidmontanStationsStages::insert($stations_finish);

                        $ajax_redirect_url = route('setup.index', $category->id);
                        $ajax_message_response = "Datele au fost adaugate.";
                        $ajax_title_response = "Felicitări!";
                        $ajax_status_response = "success";
                        return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
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
            return redirect()->route('setup.index', $category->id)->with($notification);
        }
    }



    public function orienteering_setup_stages($id, Request $request)
    {
        if( $request->ajax() )
        {
            $category = Category::FindOrFail($id);
            if($category == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Categoria sau Echipa nu exista in baza de date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('setup.index', $category->id)->with($notification);
            } else {

                    $orienteering_setup_stages = OrienteeringStationsStages::where('category_id', $id)->get();
                    if($orienteering_setup_stages->isEmpty() == true){
                        $ajax_status_response = "success";
                        return response()->json( [
                            'ajax_status_response' => $ajax_status_response,
                            'view_content' => view('setup.orienteering_stages', ['orienteering_setup_stages' => $orienteering_setup_stages, 'category' => $category])->render()
                        ] );
                    } else {
                        $ajax_status_response = "success";
                        return response()->json( [
                            'ajax_status_response' => $ajax_status_response,
                            'view_content' => view('setup.orienteering_stages_update', ['orienteering_setup_stages' => $orienteering_setup_stages, 'category' => $category])->render()
                        ] );
                    }
            }

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('setup.index', $category->id)->with($notification);
        }
    }

    public function orienteering_setup_stages_update($id, Request $request)

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
                    return redirect()->route('setup.index', $category->id)->with($notification);
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

                    if(count($post) == 0){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'Verificati datele introduse la minute de pauza, minutele trebuie sa fie in format numeric!');
                        });
                    } else {
                        foreach($post as $t){
                            if(is_numeric($t) == false){
                                $validator->after(function ($validator) {
                                    $validator->errors()->add('form_corruption', 'Verificati datele introduse la minute de pauza, minutele trebuie sa fie in format numeric!');
                                });
                            }
                        }
                    }

                    if($validator->passes())
                    {

                        $stages_array = [];
                        foreach($post as $key => $stage){
                            $stages_array[$key]['category_id'] =  $category->id;
                            $stages_array[$key]['post'] =  $stage;
                            $stages_array[$key]['created_at'] =  $data['created_at'];
                            $stages_array[$key]['updated_at'] =  $data['updated_at'];
                        }

                        OrienteeringStationsStages::where('category_id', $id)->delete();
                        OrienteeringStationsStages::insert($stages_array);

                            $ajax_redirect_url = route('setup.index', $category->id);
                            $ajax_message_response = "Datele au fost adaugate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
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


    public function destroy(Request $request)
    {
        if( $request->ajax() )
        {

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
                    Club::query()->truncate();
                    Team::query()->truncate();
                    RaidmontanParticipations::query()->truncate();
                    RaidmontanParticipationsEntries::query()->truncate();
                    Orienteering::query()->truncate();
                    Knowledge::query()->truncate();
                    Cultural::query()->truncate();
                }

                if($data['delete_teams'] == true){
                    Team::query()->truncate();
                    RaidmontanParticipations::query()->truncate();
                    RaidmontanParticipationsEntries::query()->truncate();
                    Orienteering::query()->truncate();
                    Knowledge::query()->truncate();
                }

                if($data['delete_config_raid_montan'] == true){
                    RaidmontanStations::query()->truncate();
                    RaidmontanStationsStages::query()->truncate();
                    RaidmontanParticipations::query()->truncate();
                    RaidmontanParticipationsEntries::query()->truncate();
                }

                if($data['delete_config_orienteering'] == true){
                    OrienteeringStationsStages::query()->truncate();
                }

                if($data['delete_rezults_raid_montan'] == true){
                    RaidmontanParticipations::query()->truncate();
                    RaidmontanParticipationsEntries::query()->truncate();
                }

                if($data['delete_rezults_orienteering'] == true){
                    Orienteering::query()->truncate();
                }

                if($data['delete_rezults_knowledge'] == true){
                    Knowledge::query()->truncate();
                }

                if($data['delete_rezults_cultural'] == true){
                    Cultural::query()->truncate();
                }

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

    public function demo_data_1()
    {
        Club::query()->truncate();
        Team::query()->truncate();
        RaidmontanParticipations::query()->truncate();
        RaidmontanParticipationsEntries::query()->truncate();
        Orienteering::query()->truncate();
        Knowledge::query()->truncate();
        Cultural::query()->truncate();
        RaidmontanStations::query()->truncate();
        RaidmontanStationsStages::query()->truncate();
        DB::unprepared(file_get_contents('db_demo/demo_stafeta_100_echipe_31_cluburi.sql'));
        $notification = array(
            'success_title' => 'Success!!',
            'message' => 'Datele DEMO au fost importate',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }

    public function demo_data_2()
    {
        Club::query()->truncate();
        Team::query()->truncate();
        RaidmontanParticipations::query()->truncate();
        RaidmontanParticipationsEntries::query()->truncate();
        Orienteering::query()->truncate();
        Knowledge::query()->truncate();
        Cultural::query()->truncate();
        RaidmontanStations::query()->truncate();
        RaidmontanStationsStages::query()->truncate();
        DB::unprepared(file_get_contents('db_demo/demo_stafeta_90_echipe_24_cluburi.sql'));
        $notification = array(
            'success_title' => 'Success!!',
            'message' => 'Datele DEMO au fost importate',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    }

    public function convert_raid_to_ultra()
    {
        $teams = Team::with('uuid_raid')->with('raidmontan_participations')->with('raidmontan_participations_entries')->get();

        foreach($teams as $key => $team){

            $raidmontan_stations_stages = RaidmontanStationsStages::where('category_id', $team->category_id)->whereNotIn('post', [251,252])->get();
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


    public function convert_orienteering_to_ultra()
    {
        $teams = Team::with('uuid_orienteering')->with('orienteering')->get();

        foreach($teams as $key => $team){
            $orienteering_stations_stages = OrienteeringStationsStages::where('category_id', $team->category_id)->whereNotIn('post', [251,252])->get();
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
