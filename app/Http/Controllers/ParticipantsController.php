<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use DB;
use PDF;
use App\Models\Category;
use App\Models\Club;
use App\Models\Team;
use App\Models\Stages;
use App\Models\Participants;
use App\Models\ParticipantsStages;
use App\Models\Orienteering;
use App\Models\RaidmontanStations;
use App\Models\OrienteeringStationsStages;
use App\Models\Knowledge;
use App\Models\Climb;
use App\Models\RaidmontanParticipations;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\ClubsStageRankings;
use App\Models\ClubsStageCategoryRankings;

class ParticipantsController extends Controller
{


    public function dashboard()
    {
        $stages = Stages::get();
        $count_stages = $stages->count();
        $count_participants = Participants::get()->count();        
        return view('participants.dashboard',compact('count_participants', 'count_stages', 'stages'));
    }

    public function participants_list()
    {

        return view('participants.participants_list');
    }

    public function participants_list_datatables(Request $request)
    {
        if ($request->ajax()) {  

            $participants = Participants::get();  
                return Datatables::of($participants)
                    ->addColumn('actions', function ($row) {
                        $actions = '<div class="dropdown">
                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <a class="dropdown-item js--participants-edit" data-id="' . $row->id . '" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                <span>Edit</span>
                            </a>
                            <a class="dropdown-item js--participants-destroy" data-id="' . $row->id . '" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                <span>Delete</span>
                            </a>
                        </div>
                    <div></div></div>';
                        return $actions;
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
        }  else {
            $notification = array(
                'ajax_reponse_title' => 'Eroare!!',
                'ajax_reponse_message' => 'Ilegal operation. The administrator was notified.',
                'ajax_reponse_type' => 'error'
            );
            return redirect()->route('participants.dashboard')->with($notification);
        }
    }


    public function create(Request $request)
    {
        if( $request->ajax() )
        {
                $ajax_status_response = "success";
                return response()->json( [
                    'ajax_status_response' => $ajax_status_response,
                    'view_content' => view('participants.create')->render()
                ] );
        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation. The administrator was notified.',
                'alert-type' => 'error'
            );
            return redirect()->route('participants.dashboard')->with($notification);
        }
    }

    public function store(Request $request)
    {
        if( $request->ajax() )
        {
    
            $rules = [
                'phone' => [
                    'required',
                ],
                'name' => 'required|min:5|max:255',
            ];

            $request->merge(['created_at' => date('Y-m-d H:i:s')]);
            $request->merge(['updated_at' => date('Y-m-d H:i:s')]);

            $data = $request->only(['ci', 'phone', 'name', 'created_at', 'updated_at']);

            $validator = Validator::make($data, $rules);
    
            if($validator->passes())
            {
    
                $ci =  strip_tags($request->input('ci'), '');
                $phone =  strip_tags($request->input('phone'), '');
                $name =  strip_tags($request->input('name'), '');
                $data['ci'] = $ci;
                $data['phone'] = $phone;
                $data['name'] = $name;    
    
                Participants::create($data);

                $notification = array(
                    'ajax_title_response' => 'Adaugat!',
                    'ajax_message_response' => 'Participantul a fost adaugat!',
                    'ajax_status_response' => 'success'
                );

                return response()->json($notification);
    
                
            } else {
                return Response::json(['errors' => $validator->errors()]);
            }
        
        }  else {
            $notification = array(
                'ajax_title_response' => 'Eroare!!',
                'ajax_message_response' => 'Ilegal operation. The administrator was notified.',
                'ajax_status_response' => 'error'
            );
            return redirect()->route('participants.dashboard')->with($notification);
        }
    }

    public function edit($id, Request $request)
    {
        if( $request->ajax() )
        {
            $participant = Participants::find($id);
            if ($participant == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );
            } else {
                $ajax_status_response = "success";
                return response()->json( [
                    'ajax_status_response' => $ajax_status_response,
                    'view_content' => view('participants.edit', compact('participant'))->render()
                ] );
            }
        }  else {
            $notification = array(
                'ajax_title_response' => 'Eroare!!',
                'ajax_message_response' => 'Ilegal operation. The administrator was notified.',
                'ajax_status_response' => 'error'
            );
            return redirect()->route('participants.dashboard')->with($notification);
        }
    }

    public function update(Request $request, $id)    {
        if( $request->ajax() )
        {
            $participant = Participants::find($id);

            if ($participant == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );
            } else {

                $ci =  strip_tags($request->input('ci'), '');
                $phone =  strip_tags($request->input('phone'), '');
                $name =  strip_tags($request->input('name'), '');
                    if($phone == $participant->phone){
                        $rules = [
                            'phone' => 'required',
                            'name' => 'required|min:5|max:255',
                        ];
                    } else {
                        $rules = [
                            'ci' => 'unique:participants,ci',
                            'phone' => 'required',
                            'name' => 'required|min:5|max:255',
                        ];

                    }
    
                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);

                    $data = $request->only(['ci', 'phone', 'name', 'updated_at']);

                    $validator = Validator::make($data, $rules);
                    

                    if($validator->passes())
                    {

                        if($ci == $participant->ci){
                            unset($data['ci']);
                            $data['name'] = $name;
                        } else {
                            $data['ci'] = $ci;
                            $data['phone'] = $phone;
                            $data['name'] = $name;
                        } 

                        Participants::findOrFail($id)->update($data);

                        $ajax_message_response = "Participantul a fost modificat!";
                        $ajax_title_response = "Felicitări!";
                        $ajax_status_response = "success";
                        return response()->json(['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response]);

                    } else {
                        return response()->json(['errors' => $validator->errors()]);
                    }

            }
        }  else {
            $notification = array(
                'ajax_title_response' => 'Eroare!!',
                'ajax_message_response' => 'Ilegal operation. The administrator was notified.',
                'ajax_status_response' => 'error'
            );
            return redirect()->route('participants.dashboard')->with($notification);
        }
    }

    public function destroy($id, Request $request)
    {
        if( $request->ajax() )
        {
            $participant = Participants::find($id);
            if ($participant == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );
            } else {
                $ajax_status_response = "success";
                return response()->json( [
                    'ajax_status_response' => $ajax_status_response,
                    'view_content' => view('participants.destroy', compact('participant'))->render()
                ] );
            }
        }  else {
            $notification = array(
                'ajax_title_response' => 'Eroare!!',
                'ajax_message_response' => 'Ilegal operation. The administrator was notified.',
                'ajax_status_response' => 'error'
            );
            return redirect()->route('participants.dashboard')->with($notification);
        }
    }

    public function destroy_confirm($id, Request $request)
    {
        if( $request->ajax() )
        {
            $participant = Participants::find($id);
            if ($participant == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );
            } else {

                $check_participant = ParticipantsStages::where('participant_id', $participant->id)->get()->count();
                if($check_participant > 0){
                    $ajax_message_response = "Participantul nu poate fi sters, a fost deja asociat unei echipe.";
                    $ajax_title_response = "Eroare!";
                    $ajax_status_response = "error";
                    return response()->json(['ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'ajax_status_response' => $ajax_status_response]);   
                } else {
                    $participant->delete();
                    $ajax_status_response = "success";
                    $ajax_message_response = "Participantul a fost sters!";
                    $ajax_title_response = "Success!";
                    return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );   
                }
            }
        }  else {
            $notification = array(
                'ajax_title_response' => 'Eroare!!',
                'ajax_message_response' => 'Ilegal operation. The administrator was notified.',
                'ajax_status_response' => 'error'
            );
            return redirect()->route('participants.dashboard')->with($notification);
        }
    }

    public function participants_stages_list($stage_id)
    {
        return view('participants.participants_stages_list', compact('stage_id') );
    }

    public function participants_stages_list_datatables($stage_id, Request $request)
    {
        if ($request->ajax()) {

            $teams = Team::with('participants')->with('category')->with('club')->where('stage_id', $stage_id)->get();
                return Datatables::of($teams)
                ->addColumn('club', function($row){
                    $club = $row->club->name;
                    return $club;
                })
                ->addColumn('category', function($row){
                    $category = $row->category->name;
                    return $category;
                })
                ->addColumn('participants', function($row){
                    $participants = $row->participants->count();
                    return $participants;
                })
                ->addColumn('actions', function ($row) {
                    $actions = '<div class="dropdown">
                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                        <a class="dropdown-item js--participants-stages-edit" data-stageid="' . $row->stage_id .'" data-id="' . $row->id . '" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                            <span>Edit</span>
                        </a>
                        <a class="dropdown-item js--participants-stages-destroy" data-stageid="' . $row->stage_id .'" data-id="' . $row->id . '" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            <span>Delete</span>
                        </a>
                    </div>
                <div></div></div>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }  else {
            $notification = array(
                'ajax_reponse_title' => 'Eroare!!',
                'ajax_reponse_message' => 'Ilegal operation. The administrator was notified.',
                'ajax_reponse_type' => 'error'
            );
            return redirect()->route('participants.dashboard')->with($notification);
        }
    }


    public function participants_stages_list_edit($stageid, $id, Request $request)
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
    
            $team = Team::where('stage_id', $stageid)->where('id', $id)->first();

            $participants_stages = ParticipantsStages::with('participants')->where('stage_id', $stageid)->where('team_id', $team->id)->get();

            $participants_stages_used_teams = ParticipantsStages::with('participants')->where('stage_id', $stageid)->whereNotIn('team_id', [$team->id])->get();
            $participant_used = [];
            foreach($participants_stages_used_teams as $participant){
                $participant_used[] = $participant->participant_id;
            }

            $participants = Participants::whereNotIn('id', $participant_used)->get();

            $collection = collect([0]);
            foreach ($participants_stages as $participant_stage){
                $collection->push($participant_stage->participant_id);
            }
            $searchparticipant = $collection->all();
            $searchparticipant = collect($searchparticipant);

            if ($team == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );
            } else {
                $ajax_status_response = "success";
                return response()->json( [
                    'ajax_status_response' => $ajax_status_response,
                    'view_content' => view('participants.participants_stages_edit', compact('team', 'participants_stages', 'participants', 'searchparticipant'))->render()
                ] );
            }
        }  else {
            $notification = array(
                'ajax_title_response' => 'Eroare!!',
                'ajax_message_response' => 'Ilegal operation. The administrator was notified.',
                'ajax_status_response' => 'error'
            );
            return redirect()->route('participants.dashboard')->with($notification);
        }
    }


    public function participants_stages_list_update($stageid, $id, Request $request, ParticipantsStages $ParticipantsStages)
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
    
            $team = Team::where('stage_id', $stageid)->where('id', $id)->first();

            if ($team == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );
            } else {

                if(!empty($request->input('participants'))){
                    $create_array_ajax_participants = explode(',', $request->input('participants'));
                    $request->merge(['participants' => $create_array_ajax_participants]);
                }

                    $rules = [
                        'participants' => 'required|array|min:3|max:3',
                        'participants.*' => 'required|numeric|exists:participants,id',
                    ];

                    $data = $request->only(['participants']);
                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                    $data = $request->only(['participants', 'updated_at']);
                    $validator = Validator::make($data, $rules);

                    if($validator->passes())
                    {


                        ParticipantsStages::where('stage_id', $team->stage_id)->where('team_id', $team->id)->delete();

                        unset($data['participants']);

                        $categoryArray = [];

                        foreach ($request->get('participants') as $participant)
                        {
                            $participantsStagesArray[] = [
                                'stage_id' => $team->stage_id,
                                'participant_id'=> $participant,
                                'team_id'=> $team->id,
                                'created_at' => $data['updated_at'],
                                'updated_at' => $data['updated_at']
                            ];
                        }

                        $ParticipantsStages->create($participantsStagesArray);


                        $ajax_message_response = "Participantii au fost adaugati!";
                        $ajax_title_response = "Felicitari!";
                        $ajax_status_response = "success";
                        return response()->json(["ajax_status_response" => $ajax_status_response, "ajax_title_response" => $ajax_title_response, "ajax_message_response" => $ajax_message_response]);

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
            return redirect()->route('participants.dashboard')->with($notification);
        }

    }    


    public function participants_stages_list_destroy($stageid, $id, Request $request)
    {
        if( $request->ajax() )
        {
            $participants_stages = ParticipantsStages::with('participants')->where('stage_id', $stageid)->where('team_id', $id)->get();
            $team = Team::with('category')->with('club')->where('stage_id', $stageid)->where('id', $id)->first();
            
            if ($participants_stages == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );
            } else {
                $ajax_status_response = "success";
                $team_id = $id;
                return response()->json( [
                    'ajax_status_response' => $ajax_status_response,
                    'view_content' => view('participants.participants_stages_destroy', compact('participants_stages', 'stageid', 'team_id', 'team'))->render()
                ] );
            }
        }  else {
            $notification = array(
                'ajax_title_response' => 'Eroare!!',
                'ajax_message_response' => 'Ilegal operation. The administrator was notified.',
                'ajax_status_response' => 'error'
            );
            return redirect()->route('participants.dashboard')->with($notification);
        }
    }
    
    public function participants_stages_list_destroy_confirm($stageid, $id, Request $request)
    {
        if( $request->ajax() )
        {
            $participants_stages = ParticipantsStages::where('stage_id', $stageid)->where('team_id', $id)->get();
            if ($participants_stages == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );
            } else {
                ParticipantsStages::where('stage_id', $stageid)->where('team_id', $id)->delete();
                $ajax_status_response = "success";
                $ajax_message_response = "Participantii au fost stersi!";
                $ajax_title_response = "Eroare!";
                return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );
            }
        }  else {
            $notification = array(
                'ajax_title_response' => 'Eroare!!',
                'ajax_message_response' => 'Ilegal operation. The administrator was notified.',
                'ajax_status_response' => 'error'
            );
            return redirect()->route('participants.dashboard')->with($notification);
        }
    }


    public function participants_rankingcumulatclubs()
    {
        $stages = Stages::orderBy('id', 'asc')->get();
        $clubs = Club::get();
        $categories = Category::get();

        // $username = '';
        // $password = '';

        foreach ($stages as $stage) {
            $url = route('rankings.general', $stage->id);
            $response = Http::get($url);
            // $response = Http::withBasicAuth($username, $password)->get($url);
        }
    
        // General Cumulat
        $ranks = [];
        foreach ($stages as $stage) {
            foreach ($clubs as $club) {
                if (!isset($ranks[$club->id]['total'])) {
                    $ranks[$club->id]['total'] = 0;
                }
                $ranks[$club->id]['name'] = $club->name;
                $ClubsStageRankings = ClubsStageRankings::with('club')->where('club_id', $club->id)->where('stage_id', $stage->id)->get();
                if ($ClubsStageRankings->isEmpty()) {
                    $ranks[$club->id]['stages'][$stage->id] = 0;
                } else {
                    foreach ($ClubsStageRankings as $clubstagerank) {
                        $ranks[$club->id]['stages'][$stage->id] = $clubstagerank->scor;
                        $ranks[$club->id]['total'] += $clubstagerank->scor;
                    }
                }
            }
        }

        $ranks = collect($ranks);
        $ranks = $ranks->sortBy([
            ['total', 'desc']
        ]);
        // convert to array + reindex array key to be from 0 to ...
        $rankings  = array_values($ranks->toArray());
        $x = 1;
        $unique_id = 0;
        foreach($rankings as $key => $team){
            $decrease_rank = 0;
            $rankings[$key]['rank'] = $x;
                if(isset($rankings[$key-1]))
                {
                    if($team['total'] == $rankings[$key-1]['total'] && $team['total'] == $rankings[$key-1]['total'])
                    {
                        $decrease_rank = 1;
                        $rankings[$key]['rank'] = $x-1;
                    }
                }   
            if($decrease_rank == 0)
            {
                $x++;
            }
            $unique_id++;
        }


        //General Cumulat Categories
        
        $clubsstagecategoryrankings_rankings = [];

        foreach ($categories as $category) {
            $categoryId = $category->id;
        
            $records_club_stage_category = ClubsStageCategoryRankings::with('club')
                ->where('category_id', $categoryId)
                ->get()
                ->groupBy('club_id');
        
            $clubsstagecategoryrankings_array = [];
        
            foreach ($records_club_stage_category as $clubId => $clubRecords) {
                $row = ['club_name' => $clubRecords->first()->club->name];
        
                // Initialize dynamic stage columns
                foreach ($stages as $stage) {
                    $row['stage_' . $stage->id] = 0;
                }
        
                // Fill in scores
                $row['total'] = 0;
                foreach ($clubRecords as $record) {
                    $key = 'stage_' . $record->stage_id;
                    if (array_key_exists($key, $row)) {
                        $row[$key] = $record->scor;
                        $row['total'] += $record->scor;
                    }
                }
        
                $clubsstagecategoryrankings_array[] = $row;
            }
        
            // Sort and assign ranks
            $sorted = collect($clubsstagecategoryrankings_array)->sortByDesc('total')->values()->toArray();
        
            $x = 1;
            foreach ($sorted as $key => &$team) {
                $team['rank'] = $x;
                if (
                    $key > 0 &&
                    $team['total'] == $sorted[$key - 1]['total']
                ) {
                    $team['rank'] = $sorted[$key - 1]['rank'];
                } else {
                    $x++;
                }
            }
        
            $clubsstagecategoryrankings_rankings[$categoryId] = $sorted;

            
        }
        
        return view('participants.participants_clubs_stage_rankings', compact('rankings', 'clubsstagecategoryrankings_rankings', 'categories', 'stages') );

    }

    public function participants_rankingcumulatclubs_pdf()
    {
        $stages = Stages::orderBy('id', 'asc')->get();
        $clubs = Club::get();
        $categories = Category::get();
    
        $ranks = [];
        foreach ($stages as $stage) {
            foreach ($clubs as $club) {
                if (!isset($ranks[$club->id]['total'])) {
                    $ranks[$club->id]['total'] = 0;
                }
                $ranks[$club->id]['name'] = $club->name;
                $ClubsStageRankings = ClubsStageRankings::with('club')->where('club_id', $club->id)->where('stage_id', $stage->id)->get();
                if ($ClubsStageRankings->isEmpty()) {
                    $ranks[$club->id]['stages'][$stage->id] = 0;
                } else {
                    foreach ($ClubsStageRankings as $clubstagerank) {
                        $ranks[$club->id]['stages'][$stage->id] = $clubstagerank->scor;
                        $ranks[$club->id]['total'] += $clubstagerank->scor;
                    }
                }
            }
        }

        $ranks = collect($ranks);
        $ranks = $ranks->sortBy([
            ['total', 'desc']
        ]);
        // convert to array + reindex array key to be from 0 to ...
        $rankings  = array_values($ranks->toArray());
        $x = 1;
        $unique_id = 0;
        foreach($rankings as $key => $team){
            $decrease_rank = 0;
            $rankings[$key]['rank'] = $x;
                if(isset($rankings[$key-1]))
                {
                    if($team['total'] == $rankings[$key-1]['total'] && $team['total'] == $rankings[$key-1]['total'])
                    {
                        $decrease_rank = 1;
                        $rankings[$key]['rank'] = $x-1;
                    }
                }   
            if($decrease_rank == 0)
            {
                $x++;
            }
            $unique_id++;
        }

        //General Cumulat Categories
        
        $clubsstagecategoryrankings_rankings = [];

        foreach ($categories as $category) {
            $categoryId = $category->id;
        
            $records_club_stage_category = ClubsStageCategoryRankings::with('club')
                ->where('category_id', $categoryId)
                ->get()
                ->groupBy('club_id');
        
            $clubsstagecategoryrankings_array = [];
        
            foreach ($records_club_stage_category as $clubId => $clubRecords) {
                $row = ['club_name' => $clubRecords->first()->club->name];
        
                // Initialize dynamic stage columns
                foreach ($stages as $stage) {
                    $row['stage_' . $stage->id] = 0;
                }
        
                // Fill in scores
                $row['total'] = 0;
                foreach ($clubRecords as $record) {
                    $key = 'stage_' . $record->stage_id;
                    if (array_key_exists($key, $row)) {
                        $row[$key] = $record->scor;
                        $row['total'] += $record->scor;
                    }
                }
        
                $clubsstagecategoryrankings_array[] = $row;
            }
        
            // Sort and assign ranks
            $sorted = collect($clubsstagecategoryrankings_array)->sortByDesc('total')->values()->toArray();
        
            $x = 1;
            foreach ($sorted as $key => &$team) {
                $team['rank'] = $x;
                if (
                    $key > 0 &&
                    $team['total'] == $sorted[$key - 1]['total']
                ) {
                    $team['rank'] = $sorted[$key - 1]['rank'];
                } else {
                    $x++;
                }
            }
        
            $clubsstagecategoryrankings_rankings[$categoryId] = $sorted;

            
        }

        $pdf = PDF::loadView('participants.participants_clubs_stage_rankings_pdf', ['rankings' => $rankings, 'clubsstagecategoryrankings_rankings' => $clubsstagecategoryrankings_rankings, 'categories' => $categories, 'stages' => $stages]);
        $pdf->setPaper('A4', 'landscape');
        $rankings = 'ClasamentGeneralCumulat.pdf';
        return $pdf->stream($rankings);

    }


    public function participants_rankingcumulatparticipants()
    {

        $stages = Stages::get();
        $categories = Category::get();

        // $username = '';
        // $password = '';

        foreach ($stages as $stage) {
            foreach ($categories as $category) {
                $url = route('rankings.category.general', [$stage->id, $category->id]);
                $response = Http::get($url);
                // $response = Http::withBasicAuth($username, $password)->get($url);
            }
        }

        $results = DB::table('participants')
        ->select('participants.id', 'participants.name', 'participants_stages.stage_id', 'participants_stage_rankings.club_id', 'participants_stage_rankings.team_id', 'participants_stage_rankings.category_name','clubs.name as club_name', 'participants_stage_rankings.scor')
        ->leftJoin('participants_stages', 'participants_stages.participant_id', '=', 'participants.id')
        ->leftJoin('participants_stage_rankings', 'participants_stage_rankings.team_id', '=', 'participants_stages.team_id')
        ->leftJoin('clubs','clubs.id','=','participants_stage_rankings.club_id')
        ->groupBy('participants.id', 'participants.name', 'participants_stages.stage_id', 'participants_stage_rankings.club_id', 'participants_stage_rankings.team_id','participants_stage_rankings.category_name','clubs.name','participants_stage_rankings.scor')
        ->get();

        $participantsStats = [];
        foreach( $results as $result )
        {
            // var_dump($result);
            $participantsStats[$result->id]['name'] = $result->name;
            $score = $result->scor ?? 0;
            $participantsStats[$result->id]['total_score'] = ( !empty($participantsStats[$result->id]['total_score']) ) ? $participantsStats[$result->id]['total_score'] + $score : $score;
            $participantsStats[$result->id]['stages'][$result->stage_id] = $result;   
            if( !empty($participantsStats[$result->id]['club']) && in_array($result->club_name,$participantsStats[$result->id]['club']) )
            {
               //deja exista
            } else {
                $participantsStats[$result->id]['club'][] = $result->club_name;
            }      
        } 

        
        // dd($participantsStats);
        
        $participantsStats = collect($participantsStats);
        $participantsStats = $participantsStats->sortBy([
            ['total_score', 'desc'],
        ]);

        // convert to array + reindex array key to be from 0 to ...
        $rankingsparticipantsStats  = array_values($participantsStats->toArray());

        $x = 1;
        $unique_id = 0;
        foreach($rankingsparticipantsStats as $key => $participantrank){
            $decrease_rank = 0;
            $rankingsparticipantsStats[$key]['rank'] = $x;
                if(isset($rankingsparticipantsStats[$key-1]))
                {
                    if($participantrank['total_score'] == $rankingsparticipantsStats[$key-1]['total_score'] && $participantrank['total_score'] == $rankingsparticipantsStats[$key-1]['total_score'])
                    {
                        $decrease_rank = 1;
                        $rankingsparticipantsStats[$key]['rank'] = $x-1;
                    }
                }   
            if($decrease_rank == 0)
            {
                $x++;
            }
            $unique_id++;
        }

        return view('participants.participants_stage_rankings', compact('rankingsparticipantsStats', 'stages') );

    }

    public function participants_rankingcumulatparticipants_pdf()
    {

        $stages = Stages::get();

        $results = DB::table('participants')
        ->select('participants.id', 'participants.name', 'participants_stages.stage_id', 'participants_stage_rankings.club_id', 'participants_stage_rankings.team_id', 'participants_stage_rankings.category_name','clubs.name as club_name', 'participants_stage_rankings.scor')
        ->leftJoin('participants_stages', 'participants_stages.participant_id', '=', 'participants.id')
        ->leftJoin('participants_stage_rankings', 'participants_stage_rankings.team_id', '=', 'participants_stages.team_id')
        ->leftJoin('clubs','clubs.id','=','participants_stage_rankings.club_id')
        
        ->groupBy('participants.id', 'participants.name', 'participants_stages.stage_id', 'participants_stage_rankings.club_id', 'participants_stage_rankings.team_id','participants_stage_rankings.category_name','clubs.name','participants_stage_rankings.scor')
        ->limit(100)
        ->get();

        $participantsStats = [];
        foreach( $results as $result )
        {
            // var_dump($result);
            $participantsStats[$result->id]['name'] = $result->name;
            $score = $result->scor ?? 0;
            $participantsStats[$result->id]['total_score'] = ( !empty($participantsStats[$result->id]['total_score']) ) ? $participantsStats[$result->id]['total_score'] + $score : $score;
            $participantsStats[$result->id]['stages'][$result->stage_id] = $result;   
            if( !empty($participantsStats[$result->id]['club']) && in_array($result->club_name,$participantsStats[$result->id]['club']) )
            {
               //deja exista
            } else {
                $participantsStats[$result->id]['club'][] = $result->club_name;
            }      
        } 
        $participantsStats = collect($participantsStats);
        $participantsStats = $participantsStats->sortBy([
            ['total_score', 'desc'],
        ]);

        // convert to array + reindex array key to be from 0 to ...
        $rankingsparticipantsStats  = array_values($participantsStats->toArray());

        $x = 1;
        $unique_id = 0;
        foreach($rankingsparticipantsStats as $key => $participantrank){
            $decrease_rank = 0;
            $rankingsparticipantsStats[$key]['rank'] = $x;
                if(isset($rankingsparticipantsStats[$key-1]))
                {
                    if($participantrank['total_score'] == $rankingsparticipantsStats[$key-1]['total_score'] && $participantrank['total_score'] == $rankingsparticipantsStats[$key-1]['total_score'])
                    {
                        $decrease_rank = 1;
                        $rankingsparticipantsStats[$key]['rank'] = $x-1;
                    }
                }   
            if($decrease_rank == 0)
            {
                $x++;
            }
            $unique_id++;
        }

        $pdf = PDF::loadView('participants.participants_stage_rankings_pdf', ['rankingsparticipantsStats' => $rankingsparticipantsStats, 'stages' => $stages]);
        $pdf->setPaper('A4', 'landscape');
        $rankingsparticipantsStats = 'participants.participants_stage_rankings_pdf';
        return $pdf->stream($rankingsparticipantsStats);

    }


}

