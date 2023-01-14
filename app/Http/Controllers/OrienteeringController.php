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

class OrienteeringController extends Controller
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
            $teams = Team::with('orienteering')->where('category_id', $id)->get();
            $number = 1;
            return view('orienteering.index',compact('category', 'teams', 'number'));
        }
    }

    public function edit($categoryid, $teamid, Request $request)
    {
        if( $request->ajax() )
        {
            $team = Team::FindOrFail($teamid);
            $category = Category::FindOrFail($categoryid);
            if($team == null || $category == null) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Categoria sau Echipa nu exista in baza de date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('orienteering.index', $categoryid)->with($notification);
            } else {
                $orienteering_result = [];
                $orienteering = Orienteering::where('team_id', $teamid)->first();
                // if the team is not already in orienteering table, populate the blade with some temporary records.
                if($orienteering == null){
                    $orienteering_result['start_time'] = "00:00:00";
                    $orienteering_result['finish_time'] = "00:00:00";
                    $orienteering_result['total_time'] = "00:00:00";
                    $orienteering_result['abandon'] = 1;
                    $orienteering_result['missed_posts'] = "";
                    $orienteering_result['order_posts'] = "";
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('orienteering.edit', ['team' => $team, 'category' => $category, 'orienteering_result' => $orienteering_result])->render()
                    ] );
                } else {
                    // if the team already have records in orienteering table get the data and populate the blade
                    $orienteering_result['start_time'] = $orienteering->start_time;
                    $orienteering_result['finish_time'] = $orienteering->finish_time;
                    $orienteering_result['total_time'] = $orienteering->total_time;
                    $orienteering_result['abandon'] = $orienteering->abandon;
                    $orienteering_result['missed_posts'] = $orienteering->missed_posts;
                    $orienteering_result['order_posts'] = $orienteering->order_posts;
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('orienteering.edit', ['team' => $team, 'category' => $category, 'orienteering_result' => $orienteering_result])->render()
                    ] );
                }
            }

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('orienteering.index', $categoryid)->with($notification);
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
                        'start_time' => 'required|date_format:H:i:s',
                        'finish_time' => 'required|date_format:H:i:s',
                        'missed_posts' => 'nullable|min:1|max:255',
                        'abandon' => 'required|numeric|between:0,2',
                    ];

                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['team_id' => $team->id]);

                    $start_time =  $request->input('start_time');
                    $finish_time =  $request->input('finish_time');

                    // Convert data with Carbon
                    $startTime = Carbon::parse($start_time);
                    $finishTime = Carbon::parse($finish_time);

                    // Get the diff between finish and start in format H I S and merge the result in total_time
                    $total_time = $finishTime->diff($startTime)->format('%H:%I:%S');
                    $request->merge(['total_time' => $total_time]);

                    $data = $request->only(['start_time', 'finish_time', 'total_time', 'missed_posts', 'abandon', 'created_at', 'updated_at', 'team_id']);
                    $validator = Validator::make($data, $rules);

                    // Check Start - Finish Time
                    if(strtotime($finishTime) < strtotime($startTime)){
                        $validator->after(function ($validator) {
                            $validator->errors()->add('start_finish_time', 'Problema Finish Time mai mic ca Start Time');
                        });
                    }

                    if($validator->passes())
                    {
                    
                    // if missed_posts is not empty , insert disqualified
                    if(!empty($data['missed_posts'])){
                        $data['abandon'] = 2;
                    }

                    $orienteering = Orienteering::where('team_id', $team->id)->first();
                        if($orienteering == null) {
                            // If the team is not in orienteering table insert the data
                            Orienteering::create($data);
                            $ajax_redirect_url = route('orienteering.index', [$categoryid, $teamid]);
                            $ajax_message_response = "Datele au fost adaugate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
                        } else {
                            // If the team exist in orienteering table update the data without created_at.
                            unset($data['created_at']);
                            Orienteering::findOrFail($orienteering->id)->update($data);
                            $ajax_redirect_url = route('orienteering.index', [$categoryid, $teamid]);
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
