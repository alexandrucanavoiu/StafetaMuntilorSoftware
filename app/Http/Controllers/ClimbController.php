<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Team;
use App\Models\Climb;
use App\Models\Category;
use App\Models\Stages;

class ClimbController extends Controller
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
    public function index($stageid, $id)
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

        $category = Category::find($id);
        if($category == null) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Categoria nu exista! URL-ul nu se editeaza manual...',
                'alert-type' => 'error'
            );
            return redirect()->route('dashboard', $stageid)->with($notification);
        } else {
            $teams = Team::where('stage_id', $stageid)->with('climb')->where('category_id', $id)->get();
            $number = 1;
            return view('climb.index',compact('category', 'teams', 'number', 'stageid'));
        }
    }

    public function edit($stageid, $categoryid, $teamid, Request $request)
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

            $team = Team::FindOrFail($teamid);
            $category = Category::FindOrFail($categoryid);
            if($team == null || $category == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Categoria sau Echipa nu exista in baza de date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('climb.index', [$stageid, $categoryid])->with($notification);
            } else {
                $climb_result = [];
                $climb = Climb::where('stage_id', $stageid)->where('team_id', $teamid)->first();
                if($climb == null){
                    // if the team is not already in Climb table, populate the blade with some temporary records.
                    $climb_result['meters'] =  0.0;
                    $climb_result['time'] = "00:00:00";
                    $climb_result['abandon'] = 1;
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('climb.edit', ['team' => $team, 'category' => $category, 'climb_result' => $climb_result, 'stageid' => $stageid])->render()
                    ] );
                } else {
                    // if the team already have records in Climb table get the data and populate the blade
                    $climb_result['meters'] = (float) $climb->meters;
                    $climb_result['time'] = $climb->time;
                    $climb_result['abandon'] = $climb->abandon;
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('climb.edit', ['team' => $team, 'category' => $category, 'climb_result' => $climb_result, 'stageid' => $stageid])->render()
                    ] );
                }
            }

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('climb.index', [$stageid, $categoryid])->with($notification);
        }
    }


    public function update($stageid, $categoryid, $teamid, Request $request)

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
                    return redirect()->route('climb.index', [$stageid, $categoryid])->with($notification);
                } else {

                    $rules = [
                        'time' => 'required|date_format:H:i:s',
                        'meters' => 'required|numeric|min:0',
                        'abandon' => 'required|numeric|between:0,2',
                    ];

                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['team_id' => $team->id]);
                    $request->merge(['stage_id' => $stageid]);

                    $data = $request->only(['time', 'meters', 'abandon', 'created_at', 'updated_at', 'team_id', 'scor', 'stage_id']);
                    $validator = Validator::make($data, $rules);

                    $stage = Stages::where('id', $stageid)->first();
                    if($stage == null){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('form_corruption', 'StageID-ul nu este corect, incercati sa nu editati in cod.');
                        });
                    }

                    if($validator->passes())
                    {
                    // calculate points
                    // if abandon is 1 p Abandon or 2 - disqualified add 0 to score, if not calculate the points.

                    $climb = Climb::where('stage_id', $stageid)->where('team_id', $team->id)->first();
                        if($climb == null) {
                            // if team doesn't have the data in db, insert it.
                            Climb::create($data);
                            $ajax_redirect_url = route('climb.index', [$stageid, $categoryid]);
                            $ajax_message_response = "Datele au fost adaugate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);
                        } else {
                            // if team have the data in db, update it without created_at.
                            unset($data['created_at']);
                            Climb::findOrFail($climb->id)->update($data);
                            $ajax_redirect_url = route('climb.index', [$stageid, $categoryid]);
                            $ajax_message_response = "Datele au fost actualizate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);

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
            return redirect()->route('dashboard', $stageid)->with($notification);
        }
    }


}
