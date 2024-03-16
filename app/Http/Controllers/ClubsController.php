<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Category;
use App\Models\Team;
use App\Models\Cultural;
use PDF;
use App\Models\Stages;

class ClubsController extends Controller
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

        $number = 1;
        $clubs = Club::OrderBy('id', 'ASC')->get();
        return view('clubs.index',compact('clubs', 'number', 'stageid'));
    }

    public function create($stageid, Request $request)
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

            $current_date = \Carbon\Carbon::now();

                $ajax_status_response = "success";
                return response()->json( [
                    'ajax_status_response' => $ajax_status_response,
                    'view_content' => view('clubs.create', compact('stageid'))->render()
                ] );


        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation. The administrator was notified.',
                'alert-type' => 'error'
            );
            return redirect()->route('dashboard')->with($notification);
        }
    }

    public function store($stageid, Request $request)
    {
        if( $request->ajax() )
        {

            $rules = [
                'clubs' => 'required|array|min:1|max:30',
                'clubs.*' => 'required||max:255|min:2',
            ];

            $request->merge(['created_at' => date('Y-m-d H:i:s')]);
            $request->merge(['updated_at' => date('Y-m-d H:i:s')]);

            if(!empty($request->input('clubs'))){
                $create_array_ajax_clubs = explode(',', $request->input('clubs'));
                $request->merge(['clubs' => $create_array_ajax_clubs]);
            }


            $data = $request->only(['clubs', 'created_at', 'updated_at']);
            $validator = Validator::make($data, $rules);

            $stage = Stages::where('id', $stageid)->first();
            if($stage == null){
                $validator->after(function ($validator) {
                    $validator->errors()->add('form_corruption', 'StageID-ul nu este corect, incercati sa nu editati in cod.');
                });
            }

            if($request->input('clubs') == null){
                $validator->after(function ($validator) {
                    $validator->errors()->add('form_corruption', 'Nume Club gol!');
                });
            } else {
                foreach($request->input('clubs') as $club_name){
                    if($club_name == ""){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'Va rugam sa verificati formularul si sa stergeti Nume Club care nu este completat!');
                        });
                    } else {
                        $find_club = Club::where('name', $club_name)->first();
                        if($find_club !== null){
                                $validator->after(function ($validator) {
                                    $validator->errors()->add('form_corruption', "Unul sau mai multe cluburi din lista exista deja in baza de date iar formularul nu poate fi salvat.");
                                });
                        }   
                    }             
                }
            }

            if($validator->passes())
            {

                foreach ($data['clubs'] as $club) {
                    if(isset($club)) {
                        Club::create([
                            'name' => trim(strip_tags($club, '')),
                            'created_at' => $data['created_at'],
                            'updated_at' => $data['updated_at'],
                        ]);
                    }
                }

                $ajax_redirect_url = route('clubs.index', [$stageid]);
                $ajax_message_response = "Datele au fost salvate.";
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


    public function edit($stageid, $id, Request $request)
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

            $club = Club::FindOrFail($id);
            if($club == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json(['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);
            } else {
                $ajax_status_response = "success";
                return response()->json( [
                    'ajax_status_response' => $ajax_status_response,
                    'view_content' => view('clubs.edit', ['club' => $club, 'stageid' => $stageid])->render()
                ] );
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


    public function update($stageid, $id, Request $request)

    {
        if( $request->ajax() )
        {
            $club = Club::FindOrFail($id);

                if($club == null) {
                    $notification = array(
                        'success_title' => 'Eroare!!',
                        'message' => 'Ilegal operation. The administrator was notified.',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('clubs.index', [$stageid])->with($notification);
                } else {

                    $rules = [
                        'name' => 'required|max:255|min:2',
                    ];

                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                    $data = $request->only(['name', 'updated_at']);
                    $validator = Validator::make($data, $rules);

                    $stage = Stages::where('id', $stageid)->first();
                    if($stage == null){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'StageID-ul nu este corect, incercati sa nu editati in cod.');
                        });
                    }

                    if($validator->passes())
                    {
                        // clean input before update in db
                        $data['name'] =  trim(strip_tags($request->input('name'), ''));

                        if($data['name'] === $club->name){
                            Club::findOrFail($id)->update($data);
                            $ajax_redirect_url = route('clubs.index', [$stageid]);
                            $ajax_message_response = "Datele au fost salvate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url,'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);
                        } else {
                            $find_club = Club::where('name', $data['name'])->first();
                            if($find_club !== null){
                                $ajax_redirect_url = route('clubs.index', [$stageid]);
                                $ajax_message_response = "Datele nu pot fi salvate, clubul " . $data['name'] . " exista in baza de date.";
                                $ajax_title_response = "Eroare!";
                                $ajax_status_response = "danger";
                                return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);
                            } else {
                                Club::findOrFail($id)->update($data);
                                $ajax_redirect_url = route('clubs.index', [$stageid]);
                                $ajax_message_response = "Datele au fost salvate.";
                                $ajax_title_response = "Felicitări!";
                                $ajax_status_response = "success";
                                return response()->json(['ajax_redirect_url' => $ajax_redirect_url,'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);
                            }
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

    public function destroy($stageid, $id, Request $request)
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

            $club = Club::FindOrFail($id);

            if ($club == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Eroare la validarea datelor.',
                    'alert-type' => 'error'
                );
                return redirect()->route('clubs.index', [$stageid])->with($notification);
            } else {
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('clubs.destroy', compact('club', 'stageid'))->render()
                    ] );
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

    public function destroy_confirm($stageid, $id, Request $request)
    {
        if( $request->ajax() )
        {
            $club = Club::FindOrFail($id);

            $stage = Stages::where('id', $stageid)->first();
            if($stage == null){
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'StageID-ul nu este valid. Incercati sa nu modificati url-urile de mana.',
                    'alert-type' => 'error'
                );
                return redirect()->route('error.alert')->with($notification);
            }

            if ($club == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Eroare la validarea datelor.',
                    'alert-type' => 'error'
                );
                return redirect()->route('clubs.index', [$stageid])->with($notification);
            } else {

                    $teams = Team::where('club_id', $club->id)->get()->count();
                    if($teams > 0){
                        $ajax_message_response = "Clubul nu poate fi sters, exista echipe asociate acestui club. Stergeti mai intai echipele!";
                        $ajax_title_response = "Eroare!";
                        $ajax_status_response = "error";
                        return response()->json(['ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'ajax_status_response' => $ajax_status_response, 'stageid' => $stageid]);   
                    } else {
                        Cultural::where('stage_id', $stageid)->where('club_id', $club->id)->delete();
                        $club->delete();
                        $ajax_redirect_url = route('clubs.index', [$stageid]);
                        $ajax_message_response = "Clubul a fost sters!";
                        $ajax_title_response = "Felicitări!";
                        $ajax_status_response = "success";
                        return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'ajax_status_response' => $ajax_status_response, 'stageid' => $stageid]);   
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


    public function clubs_listbyteams($stageid)
    {
        $clubs = Club::with('teams')->get();
        $categories = Category::get();

        $number = 1;
        $club_list = [];
        foreach($clubs as $key => $club){
            $club_list[$key]['club_name'] = $club->name;
            $club_list[$key]['total'] = $club->teams->count();
            if($club->teams->count() == 0){
                    foreach($categories as $category){
                            $club_list[$key][$category->name] = 0;
                    }
            } else {
                foreach($club->teams as $team){
                    foreach($categories as $category){
                        $count_teams = Team::where('stage_id', $stageid)->where('club_id', $club->id)->where('category_id', $category->id)->get()->count();
                            $club_list[$key][$category->name] = $count_teams;
                    }
                }
            }
        }

        $club_list = collect($club_list);


        $club_list = $club_list->sortBy([
            ['total', 'desc'],
            ['club_name', 'asc'],
        ]);

        // convert to array + reindex array key to be from 0 to ...
        $club_list  = array_values($club_list->toArray());

        return view('clubs.listbyteams',compact('club_list', 'number', 'stageid'));
    }

    public function clubs_listbyteams_pdf($stageid)
    {
        $clubs = Club::with('teams')->get();

        if($clubs->isEmpty() === false) {

            $categories = Category::get();
            $number = 1;
            $club_list = [];
            foreach($clubs as $key => $club){
                $club_list[$key]['club_name'] = $club->name;
                $club_list[$key]['total'] = $club->teams->count();
                if($club->teams->count() == 0){
                        foreach($categories as $category){
                                $club_list[$key][$category->name] = 0;
                        }
                } else {
                    foreach($club->teams as $team){
                        foreach($categories as $category){
                            $count_teams = Team::where('stage_id', $stageid)->where('club_id', $club->id)->where('category_id', $category->id)->get()->count();
                                $club_list[$key][$category->name] = $count_teams;
                        }
                    }
                }
            }


            $club_list = collect($club_list);


            $club_list = $club_list->sortBy([
                ['total', 'desc'],
                ['club_name', 'asc'],
            ]);
    
            // convert to array + reindex array key to be from 0 to ...
            $club_list  = array_values($club_list->toArray());

            $pdf = PDF::loadView('clubs.listbyteams_pdf', ['club_list' => $club_list, 'number' => $number, 'stageid' => $stageid]);

            $pdf->setPaper('A4', 'landscape');
            $listbyteams = 'listbyteams.pdf';
            return $pdf->stream($listbyteams);
        } else {
            $notification = array(
                'message' => 'Nu puteti exporta in pdf.',
                'alert-type' => 'warning'
            );

            return redirect()->route('clubs.index', [$stageid])->with($notification);
        }

    }

}
