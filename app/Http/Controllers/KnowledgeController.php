<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Team;
use App\Models\Knowledge;
use App\Models\Category;

class KnowledgeController extends Controller
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
            $teams = Team::with('knowledge')->where('category_id', $id)->get();
            $number = 1;
            return view('knowledge.index',compact('category', 'teams', 'number'));
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
                return redirect()->route('knowledge.index', $categoryid)->with($notification);
            } else {
                $knowledge_result = [];
                $knowledge = Knowledge::where('team_id', $teamid)->first();
                if($knowledge == null){
                    // if the team is not already in Knowledge table, populate the blade with some temporary records.
                    $knowledge_result['wrong_answers'] =  0;
                    $knowledge_result['time'] = "00:00:00";
                    $knowledge_result['scor'] = 0;
                    $knowledge_result['abandon'] = 1;
                    $knowledge_result['wrong_questions'] = 0;
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('knowledge.edit', ['team' => $team, 'category' => $category, 'knowledge_result' => $knowledge_result])->render()
                    ] );
                } else {
                    // if the team already have records in Knowledge table get the data and populate the blade
                    $knowledge_result['wrong_answers'] =  $knowledge->wrong_answers;
                    $knowledge_result['time'] = $knowledge->time;
                    $knowledge_result['scor'] = $knowledge->scor;
                    $knowledge_result['abandon'] = $knowledge->abandon;
                    $knowledge_result['wrong_questions'] = $knowledge->wrong_questions;
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('knowledge.edit', ['team' => $team, 'category' => $category, 'knowledge_result' => $knowledge_result])->render()
                    ] );
                }
            }

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation.',
                'alert-type' => 'error'
            );
            return redirect()->route('knowledge.index', $categoryid)->with($notification);
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
                    return redirect()->route('knowledge.index', $categoryid)->with($notification);
                } else {

                    $rules = [
                        'time' => 'required|date_format:H:i:s',
                        'wrong_answers' => 'required|numeric|between:0,15',
                        'wrong_questions' => 'required|max:255|min:1',
                        'abandon' => 'required|numeric|between:0,2',
                    ];

                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['team_id' => $team->id]);

                    $data = $request->only(['time', 'wrong_answers', 'wrong_questions', 'abandon', 'created_at', 'updated_at', 'team_id', 'scor']);
                    $validator = Validator::make($data, $rules);

                    if($validator->passes())
                    {
                    // calculate points
                    // if abandon is 1 p Abandon or 2 - disqualified add 0 to score, if not calculate the points.
                    if($data['abandon'] == 1 || $data['abandon'] == 2){
                        $data['scor'] = 0;
                    } else {
                        // each wrong answer is 20 points from 300.
                        $data['scor'] = 300 - (20 * $data['wrong_answers']);
                    }

                    $knowledge = Knowledge::where('team_id', $team->id)->first();
                        if($knowledge == null) {
                            // if team doesn't have the data in db, insert it.
                            Knowledge::create($data);
                            $ajax_redirect_url = route('knowledge.index', [$categoryid, $teamid]);
                            $ajax_message_response = "Datele au fost adaugate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
                        } else {
                            // if team have the data in db, update it without created_at.
                            unset($data['created_at']);
                            Knowledge::findOrFail($knowledge->id)->update($data);
                            $ajax_redirect_url = route('knowledge.index', [$categoryid, $teamid]);
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
