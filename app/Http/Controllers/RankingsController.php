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
use App\Models\OrienteeringStationsStages;
use App\Models\Knowledge;
use App\Models\RaidmontanParticipations;
use PDF;

class RankingsController extends Controller
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
        $categories = Category::get();
            return view('rankings.index',compact('categories'));
    }

    public function index_category($category_id)
    {
            $category = Category::FindOrFail($category_id);
            return view('rankings.index_category',compact('category'));
    }

    public function ranking_knowledge($category_id)
    {
        // Create rank for knowledge
        $category = Category::FindOrFail($category_id);
        $teams = Team::with('knowledge')->where('category_id', $category_id)->get();
        if($teams->isEmpty()) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Nu exista echipe in baza de date!',
                'alert-type' => 'error'
            );
            return redirect()->route('rankings.index_category', $category_id)->with($notification);
        } else {
            $teams_list = [];
            $teams_list_abandon = [];
            foreach($teams as $key => $team){
                if($team->knowledge == null){
                    continue;
                } else {
                    if($team->knowledge->abandon == 0){
                        $teams_list[$key]['name'] = $team->name;
                        $teams_list[$key]['wrong_answers'] = $team->knowledge->wrong_answers;
                        $teams_list[$key]['wrong_questions'] = $team->knowledge->wrong_questions;
                        $teams_list[$key]['time'] = $team->knowledge->time;
                        $teams_list[$key]['scor'] = $team->knowledge->scor;
                        $teams_list[$key]['abandon'] = $team->knowledge->abandon;
                    } elseif($team->knowledge->abandon == 1) {
                        $teams_list_abandon[$key]['name'] = $team->name;
                        $teams_list_abandon[$key]['wrong_answers'] = "0";
                        $teams_list_abandon[$key]['wrong_questions'] = "0";
                        $teams_list_abandon[$key]['time'] = "00:00:00";
                        $teams_list_abandon[$key]['scor'] = 0;
                        $teams_list_abandon[$key]['abandon'] = 1;
                    } else {
                        $teams_list_abandon[$key]['name'] = $team->name;
                        $teams_list_abandon[$key]['wrong_answers'] = "0";
                        $teams_list_abandon[$key]['wrong_questions'] = "0";
                        $teams_list_abandon[$key]['time'] = "00:00:00";
                        $teams_list_abandon[$key]['scor'] = 0;
                        $teams_list_abandon[$key]['abandon'] = 2;
                    }
                }
            }

                $collection_knowledge = collect($teams_list);
                $sorted_knowledge = $collection_knowledge->sortBy([
                    ['scor', 'desc'],
                    ['time', 'asc'],
                ]);

                $sorted_knowledge  = $sorted_knowledge->toArray();

                $rankings = array();
                $x = 1;
                $unique_id = 0;

                foreach($sorted_knowledge as $key => $team){
                    $decrease_rank = 0;
                    $rankings[$unique_id]['name'] = $team['name'];
                    $rankings[$unique_id]['wrong_answers'] = $team['wrong_answers'];
                    $rankings[$unique_id]['wrong_questions'] = $team['wrong_questions'];
                    $rankings[$unique_id]['time'] = $team['time'];
                    $rankings[$unique_id]['abandon'] = $team['abandon'];
                    $rankings[$unique_id]['scor'] = $team['scor'];
                    $rankings[$unique_id]['rank'] = $x;
                        if(isset($sorted_knowledge[$key-1]))
                        {
                            if($team['time'] == $sorted_knowledge[$key-1]['time'])
                            {
                                $decrease_rank = 1;
                                $rankings[$unique_id]['rank'] = $x-1;
                            }
                        }   
        
                    if($decrease_rank == 0)
                    {
                        $x++;
                    }
        
                    $unique_id++;
    
                }

            
            return view('rankings.knowledge',compact('rankings', 'teams_list_abandon', 'category'));
        }
    }

    public function ranking_knowledge_pdf($category_id)
    {
        $category = Category::FindOrFail($category_id);
        $teams = Team::with('knowledge')->where('category_id', $category_id)->get();
        if($teams->isEmpty()) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Nu exista echipe in baza de date!',
                'alert-type' => 'error'
            );
            return redirect()->route('rankings.index_category', $category_id)->with($notification);
        } else {
            $teams_list = [];
            $teams_list_abandon = [];
            foreach($teams as $key => $team){
                if($team->knowledge == null){
                    continue;
                } else {
                    if($team->knowledge->abandon == 0){
                        $teams_list[$key]['name'] = $team->name;
                        $teams_list[$key]['wrong_answers'] = $team->knowledge->wrong_answers;
                        $teams_list[$key]['wrong_questions'] = $team->knowledge->wrong_questions;
                        $teams_list[$key]['time'] = $team->knowledge->time;
                        $teams_list[$key]['scor'] = $team->knowledge->scor;
                        $teams_list[$key]['abandon'] = $team->knowledge->abandon;
                    } elseif($team->knowledge->abandon == 1) {
                        $teams_list_abandon[$key]['name'] = $team->name;
                        $teams_list_abandon[$key]['wrong_answers'] = "0";
                        $teams_list_abandon[$key]['wrong_questions'] = "0";
                        $teams_list_abandon[$key]['time'] = "00:00:00";
                        $teams_list_abandon[$key]['scor'] = 0;
                        $teams_list_abandon[$key]['abandon'] = 1;
                    } else {
                        $teams_list_abandon[$key]['name'] = $team->name;
                        $teams_list_abandon[$key]['wrong_answers'] = "0";
                        $teams_list_abandon[$key]['wrong_questions'] = "0";
                        $teams_list_abandon[$key]['time'] = "00:00:00";
                        $teams_list_abandon[$key]['scor'] = 0;
                        $teams_list_abandon[$key]['abandon'] = 2;
                    }
                }
            }

                $collection_knowledge = collect($teams_list);
                $sorted_knowledge = $collection_knowledge->sortBy([
                    ['scor', 'desc'],
                    ['time', 'asc'],
                ]);

                $sorted_knowledge  = $sorted_knowledge->toArray();

                $rankings = array();
                $x = 1;
                $unique_id = 0;

                foreach($sorted_knowledge as $key => $team){
                    $decrease_rank = 0;
                    $rankings[$unique_id]['name'] = $team['name'];
                    $rankings[$unique_id]['wrong_answers'] = $team['wrong_answers'];
                    $rankings[$unique_id]['wrong_questions'] = $team['wrong_questions'];
                    $rankings[$unique_id]['time'] = $team['time'];
                    $rankings[$unique_id]['abandon'] = $team['abandon'];
                    $rankings[$unique_id]['scor'] = $team['scor'];
                    $rankings[$unique_id]['rank'] = $x;
                        if(isset($sorted_knowledge[$key-1]))
                        {
                            if($team['time'] == $sorted_knowledge[$key-1]['time'])
                            {
                                $decrease_rank = 1;
                                $rankings[$unique_id]['rank'] = $x-1;
                            }
                        }   
        
                    if($decrease_rank == 0)
                    {
                        $x++;
                    }
        
                    $unique_id++;
    
                }

                $pdf = PDF::loadView('rankings.knowledge_pdf', ['rankings' => $rankings, 'teams_list_abandon' => $teams_list_abandon, 'category' => $category]);
                $pdf->setPaper('A4', 'landscape');
                // $pdf->setPaper('A4', 'portrait');
                $listrankknowledge = 'rankings.knowledge_pdf';
                return $pdf->stream($listrankknowledge);
        }
    }


    public function ranking_orienteering($category_id)
    {
        $category = Category::FindOrFail($category_id);
        $teams = Team::with('orienteering')->where('category_id', $category_id)->get();
        if($teams->isEmpty()) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Nu exista echipe in baza de date!',
                'alert-type' => 'error'
            );
            return redirect()->route('rankings.index_category', $category_id)->with($notification);
        } else {

            $teams_list = [];
            $teams_list_abandon = [];
            $teams_list_disqualified = [];
            foreach($teams as $key => $team){
                if($team->orienteering == null){
                    continue;
                } else {
                    $order_posts_result = "";
                    if($team->orienteering->abandon == 0){
                        if($team->orienteering->order_posts !== null){
                            foreach(json_decode($team->orienteering->order_posts) as $order_posts){
                                if($order_posts->post == 251){
                                    $order_posts_result .= "(Start - " . gmdate("H:i:s", $order_posts->time) . ") ";
                                } elseif($order_posts->post == 252){
                                    $order_posts_result .= " (Finish - " . gmdate("H:i:s", $order_posts->time) . ") ";
                                } else {
                                    $order_posts_result .= "(P ". $order_posts->post . " - " . gmdate("H:i:s", $order_posts->time) . ") ";
                                }
                            }
                        }
                        $teams_list[$key]['name'] = $team->name;
                        $teams_list[$key]['total_time'] = $team->orienteering->total_time;
                        $teams_list[$key]['missing'] = $team->orienteering->missed_posts;
                        $teams_list[$key]['order_posts'] = $order_posts_result;
                        $teams_list[$key]['abandon'] = $team->orienteering->abandon;
                        // convert into a timestamp
                        $teams_list[$key]['total_time_seconds'] = strtotime($team->orienteering->total_time);
                    } elseif($team->orienteering->abandon == 2) {
                        if($team->orienteering->order_posts !== null) {
                            foreach(json_decode($team->orienteering->order_posts) as $order_posts){
                                if($order_posts->post == 251){
                                    $order_posts_result .= "(Start - " . gmdate("H:i:s", $order_posts->time) . ") ";
                                } elseif($order_posts->post == 252){
                                    $order_posts_result .= " (Finish - " . gmdate("H:i:s", $order_posts->time) . ") ";
                                } else {
                                    $order_posts_result .= "(P ". $order_posts->post . " - " . gmdate("H:i:s", $order_posts->time). ") ";
                                }
                            }
                        }
                        $teams_list_disqualified[$key]['name'] = $team->name;
                        $teams_list_disqualified[$key]['total_time'] = $team->orienteering->total_time;
                        $teams_list_disqualified[$key]['missing'] = $team->orienteering->missed_posts;
                        $teams_list_disqualified[$key]['order_posts'] = $order_posts_result;
                        $teams_list_disqualified[$key]['abandon'] = $team->orienteering->abandon;
                    } else {
                        $teams_list_abandon[$key]['name'] = $team->name;
                        $teams_list_abandon[$key]['total_time'] = "00:00:00";
                        $teams_list_abandon[$key]['missing'] = "";
                        $teams_list_abandon[$key]['order_posts'] = "";
                        $teams_list_abandon[$key]['abandon'] = 1;
                    }
                }
            }


                $collection_orienteering = collect($teams_list);
                $collection_orienteering = $collection_orienteering->sortBy([
                    ['total_time', 'asc'],
                ]);

                // convert to array + reindex array key to be from 0 to ...
                $collection_orienteering  = array_values($collection_orienteering->toArray());

                // dd($collection_orienteering[1]["total_time_seconds"] - $collection_orienteering[0]["total_time_seconds"]);

                foreach($collection_orienteering as $key => $orienteering){
                    if($key == 0){
                        $collection_orienteering[$key]['scor'] = 5000;
                    } else {
                        $seconds = $orienteering['total_time_seconds'];
                        $difference = isset($seconds) ?
                            $seconds - $collection_orienteering[0]["total_time_seconds"] :
                            0;
                        $score = isset($difference) ?
                            5000 - $difference :
                            5000;
                        $collection_orienteering[$key]['scor'] = $score;
                    }
                }
                $x = 1;
                $unique_id = 0;

                foreach($collection_orienteering as $key => $team){
                    $decrease_rank = 0;
                    $collection_orienteering[$key]['rank'] = $x;
                        if(isset($collection_orienteering[$key-1]))
                        {
                            if($team['scor'] == $collection_orienteering[$key-1]['scor'])
                            {
                                $decrease_rank = 1;
                                $collection_orienteering[$key]['rank'] = $x-1;
                            }
                        }   
        
                    if($decrease_rank == 0)
                    {
                        $x++;
                    }
        
                    $unique_id++;
    
                }

            $rankings = $collection_orienteering;
            $orienteering_stations_stage = OrienteeringStationsStages::where('category_id', $category->id)->get();
            $orienteering_stations_stage_result = "";
            foreach($orienteering_stations_stage as $station){
                    if($station->post == 251){
                        $orienteering_stations_stage_result .= "Start ,";
                    } elseif($station->post == 252){
                        $orienteering_stations_stage_result .= " Finish";
                    } else {
                        $orienteering_stations_stage_result .= " P " . $station->post . " ,";
                    }
            }

            return view('rankings.orienteering',compact('rankings', 'teams_list_disqualified', 'teams_list_abandon', 'category', 'orienteering_stations_stage_result'));
        }
    }


    public function ranking_orienteering_pdf($category_id)
    {
        $category = Category::FindOrFail($category_id);
        $teams = Team::with('orienteering')->where('category_id', $category_id)->get();
        if($teams->isEmpty()) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Nu exista echipe in baza de date!',
                'alert-type' => 'error'
            );
            return redirect()->route('rankings.index_category', $category_id)->with($notification);
        } else {
            
            //if you want to show the Order Posts in pdf.
            $ultra_orienteering = request()->query('posts');
            if($ultra_orienteering == null){
                    $ultra_orienteering = "0";
            } elseif($ultra_orienteering == "0"){
                    $ultra_orienteering = "0";
            } elseif($ultra_orienteering == "1"){
                    $ultra_orienteering = "1";
            } else {
                $ultra_orienteering = "0";
            }

            $teams_list = [];
            $teams_list_abandon = [];
            $teams_list_disqualified = [];
            foreach($teams as $key => $team){
                if($team->orienteering == null){
                    continue;
                } else {
                    $order_posts_result = "";
                    if($team->orienteering->abandon == 0){
                        if($team->orienteering->order_posts !== null){
                            foreach(json_decode($team->orienteering->order_posts) as $order_posts){
                                if($order_posts->post == 251){
                                    $order_posts_result .= "(Start - " . gmdate("H:i:s", $order_posts->time) . ") ";
                                } elseif($order_posts->post == 252){
                                    $order_posts_result .= " (Finish - " . gmdate("H:i:s", $order_posts->time) . ") ";
                                } else {
                                    $order_posts_result .= "(P ". $order_posts->post . " - " . gmdate("H:i:s", $order_posts->time) . ") ";
                                }
                            }
                        }

                        $teams_list[$key]['name'] = $team->name;
                        $teams_list[$key]['total_time'] = $team->orienteering->total_time;
                        $teams_list[$key]['missing'] = $team->orienteering->missed_posts;
                        $teams_list[$key]['order_posts'] = $order_posts_result;
                        $teams_list[$key]['abandon'] = $team->orienteering->abandon;
                        // convert into a timestamp
                        $teams_list[$key]['total_time_seconds'] = strtotime($team->orienteering->total_time);
                    } elseif($team->orienteering->abandon == 2) {
                        if($team->orienteering->order_posts !== null) {
                            foreach(json_decode($team->orienteering->order_posts) as $order_posts){
                                if($order_posts->post == 251){
                                    $order_posts_result .= "(Start - " . gmdate("H:i:s", $order_posts->time) . ") ";
                                } elseif($order_posts->post == 252){
                                    $order_posts_result .= " (Finish - " . gmdate("H:i:s", $order_posts->time) . ") ";
                                } else {
                                    $order_posts_result .= "(P ". $order_posts->post . " - " . gmdate("H:i:s", $order_posts->time). ") ";
                                }
                            }
                        }
                        $teams_list_disqualified[$key]['name'] = $team->name;
                        $teams_list_disqualified[$key]['total_time'] = $team->orienteering->total_time;
                        $teams_list_disqualified[$key]['missing'] = $team->orienteering->missed_posts;
                        $teams_list_disqualified[$key]['order_posts'] = $order_posts_result;
                        $teams_list_disqualified[$key]['abandon'] = $team->orienteering->abandon;
                    } else {
                        $teams_list_abandon[$key]['name'] = $team->name;
                        $teams_list_abandon[$key]['total_time'] = "00:00:00";
                        $teams_list_abandon[$key]['missing'] = "";
                        $teams_list_abandon[$key]['order_posts'] = "";
                        $teams_list_abandon[$key]['abandon'] = 1;
                    }
                }
            }


                $collection_orienteering = collect($teams_list);
                $collection_orienteering = $collection_orienteering->sortBy([
                    ['total_time', 'asc'],
                ]);

                // convert to array + reindex array key to be from 0 to ...
                $collection_orienteering  = array_values($collection_orienteering->toArray());

                // dd($collection_orienteering[1]["total_time_seconds"] - $collection_orienteering[0]["total_time_seconds"]);

                foreach($collection_orienteering as $key => $orienteering){
                    if($key == 0){
                        $collection_orienteering[$key]['scor'] = 5000;
                    } else {
                        $seconds = $orienteering['total_time_seconds'];
                        $difference = isset($seconds) ?
                            $seconds - $collection_orienteering[0]["total_time_seconds"] :
                            0;
                        $score = isset($difference) ?
                            5000 - $difference :
                            5000;
                        $collection_orienteering[$key]['scor'] = $score;
                    }
                }
                $x = 1;
                $unique_id = 0;

                foreach($collection_orienteering as $key => $team){
                    $decrease_rank = 0;
                    $collection_orienteering[$key]['rank'] = $x;
                        if(isset($collection_orienteering[$key-1]))
                        {
                            if($team['scor'] == $collection_orienteering[$key-1]['scor'])
                            {
                                $decrease_rank = 1;
                                $collection_orienteering[$key]['rank'] = $x-1;
                            }
                        }   
        
                    if($decrease_rank == 0)
                    {
                        $x++;
                    }
        
                    $unique_id++;
    
                }

            $rankings = $collection_orienteering;

            $orienteering_stations_stage = OrienteeringStationsStages::where('category_id', $category->id)->get();
            $orienteering_stations_stage_result = "";
            foreach($orienteering_stations_stage as $station){
                    if($station->post == 251){
                        $orienteering_stations_stage_result .= "Start ,";
                    } elseif($station->post == 252){
                        $orienteering_stations_stage_result .= " Finish";
                    } else {
                        $orienteering_stations_stage_result .= " P " . $station->post . " ,";
                    }
            }

            $pdf = PDF::loadView('rankings.orienteering_pdf', ['ultra_orienteering' => $ultra_orienteering, 'rankings' => $rankings, 'teams_list_disqualified' => $teams_list_disqualified, 'teams_list_abandon' => $teams_list_abandon, 'category' => $category, 'orienteering_stations_stage_result' => $orienteering_stations_stage_result]);
            $pdf->setPaper('A4', 'landscape');
            $listrankknowledge = 'rankings.knowledge_pdf';
            return $pdf->stream($listrankknowledge);

        }
    }


    public function ranking_raidmontan($category_id)
    {
        $category = Category::FindOrFail($category_id);
        $teams = Team::with('raidmontan_participations')->with('raidmontan_participations_entries')->where('category_id', $category_id)->get();
        if($teams->isEmpty()) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Nu exista echipe in baza de date!',
                'alert-type' => 'error'
            );
            return redirect()->route('rankings.index_category', $category_id)->with($notification);
        } else {

            // raidmontan score/penality 
            $raid_montan_score_initial = 10000;
            $raid_montan_penality_per_minute = 10;
            $raid_montan_per_missing_item = 5;
            $raid_montan_penality_minumum_distance = 300;

            $teams_list = [];
            $teams_list_abandon = [];
            $teams_list_disqualified = [];
            $pa_pause_seconds = 0;

            foreach($teams as $key => $team){
                $hits_count = 1;
                $pa_count = 1;
                if($team->raidmontan_participations == null){
                    continue;
                } else {
                    if($team->raidmontan_participations->abandon == 0 && $team->raidmontan_participations->missing_footwear == 0){
                        $teams_list[$team->id]['name'] = $team->name;
                        $teams_list[$team->id]['abandon'] = 0;
                        $teams_list[$team->id]['pfa_depunctuation_total'] = 0;
                        $teams_list[$team->id]['missing_equipment_items_total'] = $raid_montan_per_missing_item * $team->raidmontan_participations->missing_equipment_items;

                        if($teams_list[$team->id]['missing_equipment_items_total'] !== 0){
                            if($teams_list[$team->id]['missing_equipment_items_total'] > 1){
                                $missing_equipment_items_name = "articole";
                            } else {
                                $missing_equipment_items_name = "articol";
                            }
                            $teams_list[$team->id]['depunctation_status'][] = "Echipament lipsa: " . $team->raidmontan_participations->missing_equipment_items . " " . $missing_equipment_items_name . " x " . $raid_montan_per_missing_item . " puncte = " . $teams_list[$team->id]['missing_equipment_items_total'] . " puncte penalizare";
                        }
                        
                        if( $team->raidmontan_participations->minimum_distance_penalty == 1){
                            $teams_list[$team->id]['minimum_distance_penalty_total'] = $raid_montan_penality_minumum_distance;
                            $teams_list[$team->id]['depunctation_status'][] = "Penalizare nerespectare distanta minima membrii: " . $raid_montan_penality_minumum_distance . " puncte";
                        } else {
                            $teams_list[$team->id]['minimum_distance_penalty_total'] = 0;
                        }

                        $key_count = 0;
                        foreach($team->raidmontan_participations_entries as $key => $participation_entries) {
                            $raidmontan_stations = RaidmontanStations::where('id', $participation_entries->raidmontan_stations_id)->first();
                            if($participation_entries->raidmontan_stations_station_type == 0){
                                $teams_list[$participation_entries->team_id]['start'] = $participation_entries->time_start;
                                $teams_list[$participation_entries->team_id]['start_in_seconds'] = strtotime($participation_entries->time_start);
                            } elseif($participation_entries->raidmontan_stations_station_type == 1) {
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['name'] = "PA " . $pa_count;
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['time'] = $participation_entries->time_start;
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['time_start'] = strtotime($participation_entries->time_start);
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['time_finish'] = strtotime($participation_entries->time_finish);
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'] = strtotime($participation_entries->time_finish) - strtotime($participation_entries->time_start);
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['maximum_time_minutes'] = $raidmontan_stations->maximum_time;
                                    $pa_pause_seconds += $teams_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'];
                                    
                                $pa_count++;
                                $key_count++;
                            } elseif($participation_entries->raidmontan_stations_station_type == 2){
                                if($participation_entries->hits == 0){
                                    $teams_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                    $teams_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = $raidmontan_stations->points;
                                    $teams_list[$team->id]['pfa_depunctuation_total'] += $raidmontan_stations->points;
                                    $teams_list[$team->id]['depunctation_status'][] = "Penalizare ratare " . $teams_list[$participation_entries->team_id]['pfa_depunctuation'][$key][0] . " cu " . $raidmontan_stations->points . " puncte";
                                } else {
                                    $teams_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                    $teams_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = 0;
                                }
                                $hits_count++;
                            } elseif($participation_entries->raidmontan_stations_station_type == 3){
                                $teams_list[$participation_entries->team_id]['finish'] = $participation_entries->time_finish;
                                $teams_list[$participation_entries->team_id]['finish_in_seconds'] = strtotime($participation_entries->time_finish);
                                $teams_list[$participation_entries->team_id]['finish_maximum_time_minutes'] = $raidmontan_stations->maximum_time;
                                // $aaa = 0;
                                // echo "<pre>";
                                // echo $aaa;
                                // echo "finish_in_seconds ";
                                // var_dump($teams_list[$participation_entries->team_id]['finish_in_seconds']);
                                // echo "<br />";
                                // echo "start_in_seconds";
                                // var_dump($teams_list[$participation_entries->team_id]['start_in_seconds']);
                                // echo "<br />";
                                // echo "pa_pause_seconds ";
                                // var_dump($pa_pause_seconds);
                                // echo "<br />";
                                // $aaa++;
                                // echo "</pre>";

                                $teams_list[$participation_entries->team_id]['total_in_seconds'] = $teams_list[$participation_entries->team_id]['finish_in_seconds'] - $teams_list[$participation_entries->team_id]['start_in_seconds'] - $pa_pause_seconds;
                                $teams_list[$participation_entries->team_id]['total_time'] = gmdate("H:i:s", $teams_list[$participation_entries->team_id]['total_in_seconds']);
                            } else {
                                continue;
                            }
                        }

                        $pa_pause_seconds = 0;

                    } elseif($team->raidmontan_participations->abandon == 2 || $team->raidmontan_participations->missing_footwear == 1) {
                        $teams_list_disqualified[$key]['name'] = $team->name;
                        $teams_list_disqualified[$key]['total_time'] = "00:00:00";
                        $teams_list_disqualified[$key]['abandon'] = 2;

                    } else {
                        $teams_list_abandon[$key]['name'] = $team->name;
                        $teams_list_abandon[$key]['total_time'] = "00:00:00";
                        $teams_list_abandon[$key]['abandon'] = 1;
                    }
                }
            }

                foreach($teams_list as $team_list_key => $team_list){

                        $total_depunctuation_minutes = 0;
                        // dd($team_list);
                        // dd($team_list['pa']);
                        $pa_list = array_values($team_list['pa']);
                        $pa_count = count($team_list['pa']) - 1;
                        foreach($pa_list as $team_raidmontan_key => $team_raidmontan){
    
                            $time_start = $team_raidmontan['time_start'];
                            $time_finish = $team_raidmontan['time_finish'];
                            $time_pause_seconds = $team_raidmontan['time_pause_seconds'];
                            $maximum_time_minutes = $team_raidmontan['maximum_time_minutes'];
    
                            if ($team_raidmontan_key == 0) {
                                $depunctuation_minutes = ((int)round((($time_start - $team_list['start_in_seconds']) / 60))) - $maximum_time_minutes;
                                if ($depunctuation_minutes <= 0){
                                    $depunctuation_minutes = 0;
                                } else {
                                    $teams_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes . " minute";
                                }
                                $teams_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes;
                                $total_depunctuation_minutes += $depunctuation_minutes;
                                // var_dump($depunctuation_minutes);                           
                            } elseif ($team_raidmontan_key == $pa_count) {

                                $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;
    
                                if ($depunctuation_minutes_pa <= 0){
                                    $depunctuation_minutes_pa = 0;
                                } else {
                                    $teams_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                                }
        
                                $teams_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                                // var_dump($depunctuation_minutes_pa);
                                $total_depunctuation_minutes += $depunctuation_minutes_pa;
        
                                $depunctuation_minutes_finish = ((int)round((($team_list['finish_in_seconds'] - $time_finish ) / 60))) - $team_list['finish_maximum_time_minutes'];
                                if ($depunctuation_minutes_finish < 0){
                                    $depunctuation_minutes_finish = 0;
                                }
        
                                if($depunctuation_minutes_finish > 0){
                                    $teams_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim F cu " . $depunctuation_minutes_finish . " minute";
                                }
                                $teams_list[$team_list_key]['total_finish_depunctuation_minutes'] = $depunctuation_minutes_finish;
                                // var_dump($depunctuation_minutes_finish);
                                $total_depunctuation_minutes += $depunctuation_minutes_finish;
                                
                            } else {                                
                                $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;                                
    
                                if ($depunctuation_minutes_pa <= 0){
                                    $depunctuation_minutes_pa = 0;
                                } else {
                                    $teams_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                                }
                                $teams_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                                $total_depunctuation_minutes += $depunctuation_minutes_pa;
                            }
                        }
    
                        $teams_list[$team_list_key]['total_depunctuation_minutes'] = $total_depunctuation_minutes;
                        $teams_list[$team_list_key]['total_score'] = $raid_montan_score_initial - $teams_list[$team_list_key]['pfa_depunctuation_total'] - ( $total_depunctuation_minutes * $raid_montan_penality_per_minute ) - $teams_list[$team_list_key]['minimum_distance_penalty_total'] - $teams_list[$team_list_key]['missing_equipment_items_total'];
                        $total_depunctuation_minutes = 0;

                }

                $collection_raidmontan = collect($teams_list);


                $collection_raidmontan = $collection_raidmontan->sortBy([
                    ['total_score', 'desc'],
                    ['total_time', 'asc']
                ]);

                // convert to array + reindex array key to be from 0 to ...
                $collection_raidmontan  = array_values($collection_raidmontan->toArray());
    
                $x = 1;
                $unique_id = 0;
    
                foreach($collection_raidmontan as $key => $team){
                    $decrease_rank = 0;
                    $collection_raidmontan[$key]['rank'] = $x;
                        if(isset($collection_raidmontan[$key-1]))
                        {
                            if($team['total_score'] == $collection_raidmontan[$key-1]['total_score'] && $team['total_time'] == $collection_raidmontan[$key-1]['total_time'])
                            {
                                $decrease_rank = 1;
                                $collection_raidmontan[$key]['rank'] = $x-1;
                            }
                        }   
        
                    if($decrease_rank == 0)
                    {
                        $x++;
                    }
        
                    $unique_id++;
    
                }
    
            $rankings = $collection_raidmontan;

            return view('rankings.raidmontan',compact('rankings', 'teams_list_disqualified', 'teams_list_abandon', 'category'));
        }
    }


    public function ranking_raidmontan_pdf($category_id)
    {
        $category = Category::FindOrFail($category_id);
        $teams = Team::with('raidmontan_participations')->with('raidmontan_participations_entries')->where('category_id', $category_id)->get();
        if($teams->isEmpty()) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Nu exista echipe in baza de date!',
                'alert-type' => 'error'
            );
            return redirect()->route('rankings.index_category', $category_id)->with($notification);
        } else {

            // raidmontan score/penality 
            $raid_montan_score_initial = 10000;
            $raid_montan_penality_per_minute = 10;
            $raid_montan_per_missing_item = 5;
            $raid_montan_penality_minumum_distance = 300;

            $teams_list = [];
            $teams_list_abandon = [];
            $teams_list_disqualified = [];
            $pa_pause_seconds = 0;

            foreach($teams as $key => $team){
                $hits_count = 1;
                $pa_count = 1;
                if($team->raidmontan_participations == null){
                    continue;
                } else {
                    if($team->raidmontan_participations->abandon == 0 && $team->raidmontan_participations->missing_footwear == 0){
                        $teams_list[$team->id]['name'] = $team->name;
                        $teams_list[$team->id]['abandon'] = 0;
                        $teams_list[$team->id]['pfa_depunctuation_total'] = 0;
                        $teams_list[$team->id]['missing_equipment_items_total'] = $raid_montan_per_missing_item * $team->raidmontan_participations->missing_equipment_items;

                        if($teams_list[$team->id]['missing_equipment_items_total'] !== 0){
                            if($teams_list[$team->id]['missing_equipment_items_total'] > 1){
                                $missing_equipment_items_name = "articole";
                            } else {
                                $missing_equipment_items_name = "articol";
                            }
                            $teams_list[$team->id]['depunctation_status'][] = "Echipament lipsa: " . $team->raidmontan_participations->missing_equipment_items . " " . $missing_equipment_items_name . " x " . $raid_montan_per_missing_item . " puncte = " . $teams_list[$team->id]['missing_equipment_items_total'] . " puncte penalizare";
                        }
                        
                        if( $team->raidmontan_participations->minimum_distance_penalty == 1){
                            $teams_list[$team->id]['minimum_distance_penalty_total'] = $raid_montan_penality_minumum_distance;
                            $teams_list[$team->id]['depunctation_status'][] = "Penalizare nerespectare distanta minima membrii: " . $raid_montan_penality_minumum_distance . " puncte";
                        } else {
                            $teams_list[$team->id]['minimum_distance_penalty_total'] = 0;
                        }

                        $key_count = 0;
                        foreach($team->raidmontan_participations_entries as $key => $participation_entries) {
                            $raidmontan_stations = RaidmontanStations::where('id', $participation_entries->raidmontan_stations_id)->first();
                            if($participation_entries->raidmontan_stations_station_type == 0){
                                $teams_list[$participation_entries->team_id]['start'] = $participation_entries->time_start;
                                $teams_list[$participation_entries->team_id]['start_in_seconds'] = strtotime($participation_entries->time_start);
                            } elseif($participation_entries->raidmontan_stations_station_type == 1) {
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['name'] = "PA " . $pa_count;
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['time'] = $participation_entries->time_start;
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['time_start'] = strtotime($participation_entries->time_start);
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['time_finish'] = strtotime($participation_entries->time_finish);
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'] = strtotime($participation_entries->time_finish) - strtotime($participation_entries->time_start);
                                    $teams_list[$participation_entries->team_id]['pa'][$key_count]['maximum_time_minutes'] = $raidmontan_stations->maximum_time;
                                    $pa_pause_seconds += $teams_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'];
                                    
                                $pa_count++;
                                $key_count++;
                            } elseif($participation_entries->raidmontan_stations_station_type == 2){
                                if($participation_entries->hits == 0){
                                    $teams_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                    $teams_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = $raidmontan_stations->points;
                                    $teams_list[$team->id]['pfa_depunctuation_total'] += $raidmontan_stations->points;
                                    $teams_list[$team->id]['depunctation_status'][] = "Penalizare ratare " . $teams_list[$participation_entries->team_id]['pfa_depunctuation'][$key][0] . " cu " . $raidmontan_stations->points . " puncte";
                                } else {
                                    $teams_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                    $teams_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = 0;
                                }
                                $hits_count++;
                            } elseif($participation_entries->raidmontan_stations_station_type == 3){
                                $teams_list[$participation_entries->team_id]['finish'] = $participation_entries->time_finish;
                                $teams_list[$participation_entries->team_id]['finish_in_seconds'] = strtotime($participation_entries->time_finish);
                                $teams_list[$participation_entries->team_id]['finish_maximum_time_minutes'] = $raidmontan_stations->maximum_time;
                                // $aaa = 0;
                                // echo "<pre>";
                                // echo $aaa;
                                // echo "finish_in_seconds ";
                                // var_dump($teams_list[$participation_entries->team_id]['finish_in_seconds']);
                                // echo "<br />";
                                // echo "start_in_seconds";
                                // var_dump($teams_list[$participation_entries->team_id]['start_in_seconds']);
                                // echo "<br />";
                                // echo "pa_pause_seconds ";
                                // var_dump($pa_pause_seconds);
                                // echo "<br />";
                                // $aaa++;
                                // echo "</pre>";

                                $teams_list[$participation_entries->team_id]['total_in_seconds'] = $teams_list[$participation_entries->team_id]['finish_in_seconds'] - $teams_list[$participation_entries->team_id]['start_in_seconds'] - $pa_pause_seconds;
                                $teams_list[$participation_entries->team_id]['total_time'] = gmdate("H:i:s", $teams_list[$participation_entries->team_id]['total_in_seconds']);
                            } else {
                                continue;
                            }
                        }

                        $pa_pause_seconds = 0;

                    } elseif($team->raidmontan_participations->abandon == 2 || $team->raidmontan_participations->missing_footwear == 1) {
                        $teams_list_disqualified[$key]['name'] = $team->name;
                        $teams_list_disqualified[$key]['total_time'] = "00:00:00";
                        $teams_list_disqualified[$key]['abandon'] = 2;
                    } else {
                        $teams_list_abandon[$key]['name'] = $team->name;
                        $teams_list_abandon[$key]['total_time'] = "00:00:00";
                        $teams_list_abandon[$key]['abandon'] = 1;
                    }
                }
            }

            foreach($teams_list as $team_list_key => $team_list){
                    
                $total_depunctuation_minutes = 0;
                // dd($team_list);
                // dd($team_list['pa']);
                $pa_list = array_values($team_list['pa']);
                $pa_count = count($team_list['pa']) - 1;
                foreach($pa_list as $team_raidmontan_key => $team_raidmontan){

                    $time_start = $team_raidmontan['time_start'];
                    $time_finish = $team_raidmontan['time_finish'];
                    $time_pause_seconds = $team_raidmontan['time_pause_seconds'];
                    $maximum_time_minutes = $team_raidmontan['maximum_time_minutes'];

                    if ($team_raidmontan_key == 0) {
                        $depunctuation_minutes = ((int)round((($time_start - $team_list['start_in_seconds']) / 60))) - $maximum_time_minutes;
                        if ($depunctuation_minutes <= 0){
                            $depunctuation_minutes = 0;
                        } else {
                            $teams_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes . " minute";
                        }
                        $teams_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes;
                        $total_depunctuation_minutes += $depunctuation_minutes;
                        // var_dump($depunctuation_minutes);                           
                    } elseif ($team_raidmontan_key == $pa_count) {

                        $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;

                        if ($depunctuation_minutes_pa <= 0){
                            $depunctuation_minutes_pa = 0;
                        } else {
                            $teams_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                        }

                        $teams_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                        // var_dump($depunctuation_minutes_pa);
                        $total_depunctuation_minutes += $depunctuation_minutes_pa;

                        $depunctuation_minutes_finish = ((int)round((($team_list['finish_in_seconds'] - $time_finish ) / 60))) - $team_list['finish_maximum_time_minutes'];
                        if ($depunctuation_minutes_finish < 0){
                            $depunctuation_minutes_finish = 0;
                        }

                        if($depunctuation_minutes_finish > 0){
                            $teams_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim F cu " . $depunctuation_minutes_finish . " minute";
                        }
                        $teams_list[$team_list_key]['total_finish_depunctuation_minutes'] = $depunctuation_minutes_finish;
                        // var_dump($depunctuation_minutes_finish);
                        $total_depunctuation_minutes += $depunctuation_minutes_finish;
                        
                    } else {                                
                        $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;                                

                        if ($depunctuation_minutes_pa <= 0){
                            $depunctuation_minutes_pa = 0;
                        } else {
                            $teams_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                        }
                        $teams_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                        $total_depunctuation_minutes += $depunctuation_minutes_pa;
                    }
                }

                $teams_list[$team_list_key]['total_depunctuation_minutes'] = $total_depunctuation_minutes;
                $teams_list[$team_list_key]['total_score'] = $raid_montan_score_initial - $teams_list[$team_list_key]['pfa_depunctuation_total'] - ( $total_depunctuation_minutes * $raid_montan_penality_per_minute ) - $teams_list[$team_list_key]['minimum_distance_penalty_total'] - $teams_list[$team_list_key]['missing_equipment_items_total'];
                $total_depunctuation_minutes = 0;

        }

                $collection_raidmontan = collect($teams_list);


                $collection_raidmontan = $collection_raidmontan->sortBy([
                    ['total_score', 'desc'],
                    ['total_time', 'asc']
                ]);

                // convert to array + reindex array key to be from 0 to ...
                $collection_raidmontan  = array_values($collection_raidmontan->toArray());
    
                $x = 1;
                $unique_id = 0;
    
                foreach($collection_raidmontan as $key => $team){
                    $decrease_rank = 0;
                    $collection_raidmontan[$key]['rank'] = $x;
                        if(isset($collection_raidmontan[$key-1]))
                        {
                            if($team['total_score'] == $collection_raidmontan[$key-1]['total_score'] && $team['total_time'] == $collection_raidmontan[$key-1]['total_time'])
                            {
                                $decrease_rank = 1;
                                $collection_raidmontan[$key]['rank'] = $x-1;
                            }
                        }   
        
                    if($decrease_rank == 0)
                    {
                        $x++;
                    }
        
                    $unique_id++;
    
                }
    
            $rankings = $collection_raidmontan;

            $pdf = PDF::loadView('rankings.raidmontan_pdf', ['rankings' => $rankings, 'teams_list_disqualified' => $teams_list_disqualified, 'teams_list_abandon' => $teams_list_abandon, 'category' => $category]);
            $pdf->setPaper('A4', 'landscape');
            $raidmontan_pdf = 'rankings.raidmontan_pdf';
            return $pdf->stream($raidmontan_pdf);

        }
    }


    public function ranking_category($category_id)
    {
        $category = Category::FindOrFail($category_id);
        $teams = Team::where('category_id', $category_id)->get();
    
        // rank for knowledge
        $teams_knowledge = Team::with('knowledge')->where('category_id', $category_id)->get();
        if($teams_knowledge->isEmpty()) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Eroare validare date!',
                'alert-type' => 'error'
            );
            return redirect()->route('dashboard')->with($notification);
        } else {
            $teams_knowledge_list = [];
            $teams_knowledge_list_abandon = [];
            foreach($teams_knowledge as $key => $team){
                if($team->knowledge == null){
                    continue;
                } else {
                    if($team->knowledge->abandon == 0){
                        $teams_knowledge_list[$key]['name'] = $team->name;
                        $teams_knowledge_list[$key]['scor'] = $team->knowledge->scor;
                        $teams_knowledge_list[$key]['abandon'] = $team->knowledge->abandon;
                    } elseif($team->knowledge->abandon == 1) {
                        $teams_knowledge_list[$key]['name'] = $team->name;
                        $teams_knowledge_list[$key]['scor'] = 0;
                        $teams_knowledge_list[$key]['abandon'] = 1;
                    } else {
                        $teams_knowledge_list[$key]['name'] = $team->name;
                        $teams_knowledge_list[$key]['scor'] = 0;
                        $teams_knowledge_list[$key]['abandon'] = 2;
                    }
                }
            }
        }

        // rank for orienteering

        $teams_orienteering = Team::with('orienteering')->where('category_id', $category_id)->get();
        
        if($teams_orienteering->isEmpty()) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Eroare validare date!',
                'alert-type' => 'error'
            );
            return redirect()->route('dashboard')->with($notification);
        } else {
            $teams_orienteering_list = [];
            foreach($teams_orienteering as $key => $team){
                if($team->orienteering == null){
                    continue;
                } else {
                    $order_posts_result = "";
                    if($team->orienteering->abandon == 0){
                        $teams_orienteering_list[$key]['name'] = $team->name;
                        $teams_orienteering_list[$key]['abandon'] = $team->orienteering->abandon;
                        $teams_orienteering_list[$key]['total_time'] = $team->orienteering->total_time;
                        // convert into a timestamp
                        $teams_orienteering_list[$key]['total_time_seconds'] = strtotime($team->orienteering->total_time);
                    }
                }
            }


                $collection_orienteering = collect($teams_orienteering_list);
                $collection_orienteering = $collection_orienteering->sortBy([
                    ['total_time', 'asc'],
                ]);

                // convert to array + reindex array key to be from 0 to ...
                $collection_orienteering  = array_values($collection_orienteering->toArray());

                // dd($collection_orienteering[1]["total_time_seconds"] - $collection_orienteering[0]["total_time_seconds"]);

                foreach($collection_orienteering as $key => $orienteering){
                    if($key == 0){
                        $collection_orienteering[$key]['scor'] = 5000;
                    } else {
                        $seconds = $orienteering['total_time_seconds'];
                        $difference = isset($seconds) ?
                            $seconds - $collection_orienteering[0]["total_time_seconds"] :
                            0;
                        $score = isset($difference) ?
                            5000 - $difference :
                            5000;
                        $collection_orienteering[$key]['scor'] = $score;
                    }
                }

            }


            $teams_orienteering_list = $collection_orienteering;


            // rank for raid montan

            $teams_raidmontan = Team::with('raidmontan_participations')->with('raidmontan_participations_entries')->where('category_id', $category_id)->get();
            if($teams_raidmontan->isEmpty()) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Eroare validare date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('dashboard')->with($notification);
            } else {
    
                // raidmontan score/penality 
                $raid_montan_score_initial = 10000;
                $raid_montan_penality_per_minute = 10;
                $raid_montan_per_missing_item = 5;
                $raid_montan_penality_minumum_distance = 300;
    
                $teams_raidmontan_list = [];
                $teams_raidmontan_list_abandon = [];
                $teams_raidmontan_list_disqualified = [];
                $pa_pause_seconds = 0;
    
                foreach($teams_raidmontan as $key => $team){
                    $hits_count = 1;
                    $pa_count = 1;
                    if($team->raidmontan_participations == null){
                        continue;
                    } else {
                        if($team->raidmontan_participations->abandon == 0 && $team->raidmontan_participations->missing_footwear == 0){
                            $teams_raidmontan_list[$team->id]['name'] = $team->name;
                            $teams_raidmontan_list[$team->id]['abandon'] = 0;
                            $teams_raidmontan_list[$team->id]['pfa_depunctuation_total'] = 0;
                            $teams_raidmontan_list[$team->id]['missing_equipment_items_total'] = $raid_montan_per_missing_item * $team->raidmontan_participations->missing_equipment_items;
    
                            if($teams_raidmontan_list[$team->id]['missing_equipment_items_total'] !== 0){
                                if($teams_raidmontan_list[$team->id]['missing_equipment_items_total'] > 1){
                                    $missing_equipment_items_name = "articole";
                                } else {
                                    $missing_equipment_items_name = "articol";
                                }
                                $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Echipament lipsa: " . $team->raidmontan_participations->missing_equipment_items . " " . $missing_equipment_items_name . " x " . $raid_montan_per_missing_item . " puncte = " . $teams_raidmontan_list[$team->id]['missing_equipment_items_total'] . " puncte penalizare";
                            }
                            
                            if( $team->raidmontan_participations->minimum_distance_penalty == 1){
                                $teams_raidmontan_list[$team->id]['minimum_distance_penalty_total'] = $raid_montan_penality_minumum_distance;
                                $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Penalizare nerespectare distanta minima membrii: " . $raid_montan_penality_minumum_distance . " puncte";
                            } else {
                                $teams_raidmontan_list[$team->id]['minimum_distance_penalty_total'] = 0;
                            }
    
                            $key_count = 0;
                            foreach($team->raidmontan_participations_entries as $key => $participation_entries) {
                                $raidmontan_stations = RaidmontanStations::where('id', $participation_entries->raidmontan_stations_id)->first();
                                if($participation_entries->raidmontan_stations_station_type == 0){
                                    $teams_raidmontan_list[$participation_entries->team_id]['start'] = $participation_entries->time_start;
                                    $teams_raidmontan_list[$participation_entries->team_id]['start_in_seconds'] = strtotime($participation_entries->time_start);
                                } elseif($participation_entries->raidmontan_stations_station_type == 1) {
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['name'] = "PA " . $pa_count;
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time'] = $participation_entries->time_start;
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_start'] = strtotime($participation_entries->time_start);
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_finish'] = strtotime($participation_entries->time_finish);
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'] = strtotime($participation_entries->time_finish) - strtotime($participation_entries->time_start);
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['maximum_time_minutes'] = $raidmontan_stations->maximum_time;
                                        $pa_pause_seconds += $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'];
                                        
                                    $pa_count++;
                                    $key_count++;
                                } elseif($participation_entries->raidmontan_stations_station_type == 2){
                                    if($participation_entries->hits == 0){
                                        $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                        $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = $raidmontan_stations->points;
                                        $teams_raidmontan_list[$team->id]['pfa_depunctuation_total'] += $raidmontan_stations->points;
                                        $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Penalizare ratare " . $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][0] . " cu " . $raidmontan_stations->points . " puncte";
                                    } else {
                                        $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                        $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = 0;
                                    }
                                    $hits_count++;
                                } elseif($participation_entries->raidmontan_stations_station_type == 3){
                                    $teams_raidmontan_list[$participation_entries->team_id]['finish'] = $participation_entries->time_finish;
                                    $teams_raidmontan_list[$participation_entries->team_id]['finish_in_seconds'] = strtotime($participation_entries->time_finish);
                                    $teams_raidmontan_list[$participation_entries->team_id]['finish_maximum_time_minutes'] = $raidmontan_stations->maximum_time;    
                                    $teams_raidmontan_list[$participation_entries->team_id]['total_in_seconds'] = $teams_raidmontan_list[$participation_entries->team_id]['finish_in_seconds'] - $teams_raidmontan_list[$participation_entries->team_id]['start_in_seconds'] - $pa_pause_seconds;
                                    $teams_raidmontan_list[$participation_entries->team_id]['total_time'] = gmdate("H:i:s", $teams_raidmontan_list[$participation_entries->team_id]['total_in_seconds']);
                                } else {
                                    continue;
                                }
                            }
    
                            $pa_pause_seconds = 0;
    
                        } elseif($team->raidmontan_participations->abandon == 2 || $team->raidmontan_participations->missing_footwear == 1) {
                            $teams_raidmontan_list_disqualified[$key]['name'] = $team->name;
                            $teams_raidmontan_list_disqualified[$key]['total_time'] = "00:00:00";
                            $teams_raidmontan_list_disqualified[$key]['abandon'] = 2;
                        } else {
                            $teams_raidmontan_list_abandon[$key]['name'] = $team->name;
                            $teams_raidmontan_list_abandon[$key]['total_time'] = "00:00:00";
                            $teams_raidmontan_list_abandon[$key]['abandon'] = 1;
                        }
                    }
                }
    

                foreach($teams_raidmontan_list as $team_list_key => $team_list){
                    
                    $total_depunctuation_minutes = 0;
                    // dd($team_list);
                    // dd($team_list['pa']);
                    $pa_list = array_values($team_list['pa']);
                    $pa_count = count($team_list['pa']) - 1;
                    foreach($pa_list as $team_raidmontan_key => $team_raidmontan){

                        $time_start = $team_raidmontan['time_start'];
                        $time_finish = $team_raidmontan['time_finish'];
                        $time_pause_seconds = $team_raidmontan['time_pause_seconds'];
                        $maximum_time_minutes = $team_raidmontan['maximum_time_minutes'];

                        if ($team_raidmontan_key == 0) {
                            $depunctuation_minutes = ((int)round((($time_start - $team_list['start_in_seconds']) / 60))) - $maximum_time_minutes;
                            if ($depunctuation_minutes <= 0){
                                $depunctuation_minutes = 0;
                            } else {
                                $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes . " minute";
                            }
                            $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes;
                            $total_depunctuation_minutes += $depunctuation_minutes;
                            // var_dump($depunctuation_minutes);                           
                        } elseif ($team_raidmontan_key == $pa_count) {

                            $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;

                            if ($depunctuation_minutes_pa <= 0){
                                $depunctuation_minutes_pa = 0;
                            } else {
                                $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                            }
    
                            $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                            // var_dump($depunctuation_minutes_pa);
                            $total_depunctuation_minutes += $depunctuation_minutes_pa;
    
                            $depunctuation_minutes_finish = ((int)round((($team_list['finish_in_seconds'] - $time_finish ) / 60))) - $team_list['finish_maximum_time_minutes'];
                            if ($depunctuation_minutes_finish < 0){
                                $depunctuation_minutes_finish = 0;
                            }
    
                            if($depunctuation_minutes_finish > 0){
                                $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim F cu " . $depunctuation_minutes_finish . " minute";
                            }
                            $teams_raidmontan_list[$team_list_key]['total_finish_depunctuation_minutes'] = $depunctuation_minutes_finish;
                            // var_dump($depunctuation_minutes_finish);
                            $total_depunctuation_minutes += $depunctuation_minutes_finish;
                            
                        } else {                                
                            $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;                                

                            if ($depunctuation_minutes_pa <= 0){
                                $depunctuation_minutes_pa = 0;
                            } else {
                                $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                            }
                            $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                            $total_depunctuation_minutes += $depunctuation_minutes_pa;
                        }
                    }

                    $teams_raidmontan_list[$team_list_key]['total_depunctuation_minutes'] = $total_depunctuation_minutes;
                    $teams_raidmontan_list[$team_list_key]['total_score'] = $raid_montan_score_initial - $teams_raidmontan_list[$team_list_key]['pfa_depunctuation_total'] - ( $total_depunctuation_minutes * $raid_montan_penality_per_minute ) - $teams_raidmontan_list[$team_list_key]['minimum_distance_penalty_total'] - $teams_raidmontan_list[$team_list_key]['missing_equipment_items_total'];
                    $total_depunctuation_minutes = 0;

                }

            }

            $ranking_general = [];
            foreach($teams as $key1 => $team) {

                $ranking_general[$team->id]['name'] = $team->name;
                $ranking_general[$team->id]['scor_knowledge'] = 0;
                $ranking_general[$team->id]['scor_orienteering'] = 0;
                $ranking_general[$team->id]['scor_raidmontan'] = 0;
                $ranking_general[$team->id]['scor_total'] = 0;

                foreach($teams_raidmontan_list as $key2 => $raidmontan){
                    if($team->name == $raidmontan['name']){
                            $ranking_general[$team->id]['scor_raidmontan'] = $raidmontan['total_score'];
                            $ranking_general[$team->id]['scor_total'] += $raidmontan['total_score'];
                    }
                }


                foreach($teams_knowledge_list as $key2 => $knowledge){
                    if($team->name == $knowledge['name']){
                        $ranking_general[$team->id]['scor_knowledge'] = $knowledge['scor'];
                        $ranking_general[$team->id]['scor_total'] += $knowledge['scor'];
                    }
                }

                foreach($teams_orienteering_list as $key2 => $orienteering){
                    if($team->name == $orienteering['name']){
                        $ranking_general[$team->id]['scor_orienteering'] = $orienteering['scor'];
                        $ranking_general[$team->id]['scor_total'] += $orienteering['scor'];
                    }
                }
            }


            // foreach($ranking_general as $key => $team){
            //     if($team['scor_raidmontan'] == 0){
            //         $ranking_general[$key]['scor_total'] = 0;
            //     }
            // }

            // dd($ranking_general);

            $ranking_general = collect($ranking_general);
            $ranking_general = $ranking_general->sortBy([
                ['scor_total', 'desc'],
            ]);

            // convert to array + reindex array key to be from 0 to ...
            $ranking_general  = array_values($ranking_general->toArray());

            // rank
            $x = 1;
            $unique_id = 0;

            foreach($ranking_general as $key => $team){
                // dd($team);
                $decrease_rank = 0;
                $ranking_general[$key]['rank'] = $x;
                    if(isset($ranking_general[$key-1]))
                    {
                        if($team['scor_total'] == $ranking_general[$key-1]['scor_total'] && $team['scor_total'] == $ranking_general[$key-1]['scor_total'])
                        {
                            $decrease_rank = 1;
                            $ranking_general[$key]['rank'] = $x-1;
                        }
                    }   
    
                if($decrease_rank == 0)
                {
                    $x++;
                }
    
                $unique_id++;
            }

            // Score Stafeta
            $initial_scor = 500;
            foreach($ranking_general as $key => $rank){
                if($rank['scor_raidmontan'] == 0){
                    $ranking_general[$key]['scor_stafeta'] = 0;
                }
                elseif($rank['scor_total'] == 0){
                    $ranking_general[$key]['scor_stafeta'] = 0;
                    $ranking_general[$key]['rank'] = "-";
                }
                elseif($rank['rank'] == 1){
                    $initial_scor = $initial_scor;
                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;

                } elseif($rank['rank'] == 2){
                    $initial_scor = $initial_scor - 20;
                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;

                } elseif($rank['rank'] == $ranking_general[$key-1]['rank']){
                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;
                } else {

                    $initial_scor = $initial_scor - 10;

                    // if $initial_sco is -10... set scor 0
                    if($initial_scor < 0){
                        $ranking_general[$key]['scor_stafeta'] = 0;
                    } else {
                        $ranking_general[$key]['scor_stafeta'] = $initial_scor;
                    }

                }
            }

            
            return view('rankings.general_category',compact('ranking_general', 'category'));

    }

    public function ranking_category_pdf($category_id)
    {
        $category = Category::FindOrFail($category_id);
        $teams = Team::where('category_id', $category_id)->get();
    
        // rank for knowledge
        $teams_knowledge = Team::with('knowledge')->where('category_id', $category_id)->get();
        if($teams_knowledge->isEmpty()) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Eroare validare date!',
                'alert-type' => 'error'
            );
            return redirect()->route('dashboard')->with($notification);
        } else {
            $teams_knowledge_list = [];
            $teams_knowledge_list_abandon = [];
            foreach($teams_knowledge as $key => $team){
                if($team->knowledge == null){
                    continue;
                } else {
                    if($team->knowledge->abandon == 0){
                        $teams_knowledge_list[$key]['name'] = $team->name;
                        $teams_knowledge_list[$key]['scor'] = $team->knowledge->scor;
                        $teams_knowledge_list[$key]['abandon'] = $team->knowledge->abandon;
                    } elseif($team->knowledge->abandon == 1) {
                        $teams_knowledge_list[$key]['name'] = $team->name;
                        $teams_knowledge_list[$key]['scor'] = 0;
                        $teams_knowledge_list[$key]['abandon'] = 1;
                    } else {
                        $teams_knowledge_list[$key]['name'] = $team->name;
                        $teams_knowledge_list[$key]['scor'] = 0;
                        $teams_knowledge_list[$key]['abandon'] = 2;
                    }
                }
            }
        }

        // rank for orienteering

        $teams_orienteering = Team::with('orienteering')->where('category_id', $category_id)->get();
        
        if($teams_orienteering->isEmpty()) {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Eroare validare date!',
                'alert-type' => 'error'
            );
            return redirect()->route('dashboard')->with($notification);
        } else {
            $teams_orienteering_list = [];
            foreach($teams_orienteering as $key => $team){
                if($team->orienteering == null){
                    continue;
                } else {
                    $order_posts_result = "";
                    if($team->orienteering->abandon == 0){
                        $teams_orienteering_list[$key]['name'] = $team->name;
                        $teams_orienteering_list[$key]['abandon'] = $team->orienteering->abandon;
                        $teams_orienteering_list[$key]['total_time'] = $team->orienteering->total_time;
                        // convert into a timestamp
                        $teams_orienteering_list[$key]['total_time_seconds'] = strtotime($team->orienteering->total_time);
                    }
                }
            }


                $collection_orienteering = collect($teams_orienteering_list);
                $collection_orienteering = $collection_orienteering->sortBy([
                    ['total_time', 'asc'],
                ]);

                // convert to array + reindex array key to be from 0 to ...
                $collection_orienteering  = array_values($collection_orienteering->toArray());

                // dd($collection_orienteering[1]["total_time_seconds"] - $collection_orienteering[0]["total_time_seconds"]);

                foreach($collection_orienteering as $key => $orienteering){
                    if($key == 0){
                        $collection_orienteering[$key]['scor'] = 5000;
                    } else {
                        $seconds = $orienteering['total_time_seconds'];
                        $difference = isset($seconds) ?
                            $seconds - $collection_orienteering[0]["total_time_seconds"] :
                            0;
                        $score = isset($difference) ?
                            5000 - $difference :
                            5000;
                        $collection_orienteering[$key]['scor'] = $score;
                    }
                }

            }


            $teams_orienteering_list = $collection_orienteering;


            // rank for raid montan

            $teams_raidmontan = Team::with('raidmontan_participations')->with('raidmontan_participations_entries')->where('category_id', $category_id)->get();
            if($teams_raidmontan->isEmpty()) {
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Eroare validare date!',
                    'alert-type' => 'error'
                );
                return redirect()->route('dashboard')->with($notification);
            } else {
    
                // raidmontan score/penality 
                $raid_montan_score_initial = 10000;
                $raid_montan_penality_per_minute = 10;
                $raid_montan_per_missing_item = 5;
                $raid_montan_penality_minumum_distance = 300;
    
                $teams_raidmontan_list = [];
                $teams_raidmontan_list_abandon = [];
                $teams_raidmontan_list_disqualified = [];
                $pa_pause_seconds = 0;
    
                foreach($teams_raidmontan as $key => $team){
                    $hits_count = 1;
                    $pa_count = 1;
                    if($team->raidmontan_participations == null){
                        continue;
                    } else {
                        if($team->raidmontan_participations->abandon == 0 && $team->raidmontan_participations->missing_footwear == 0){
                            $teams_raidmontan_list[$team->id]['name'] = $team->name;
                            $teams_raidmontan_list[$team->id]['abandon'] = 0;
                            $teams_raidmontan_list[$team->id]['pfa_depunctuation_total'] = 0;
                            $teams_raidmontan_list[$team->id]['missing_equipment_items_total'] = $raid_montan_per_missing_item * $team->raidmontan_participations->missing_equipment_items;
    
                            if($teams_raidmontan_list[$team->id]['missing_equipment_items_total'] !== 0){
                                if($teams_raidmontan_list[$team->id]['missing_equipment_items_total'] > 1){
                                    $missing_equipment_items_name = "articole";
                                } else {
                                    $missing_equipment_items_name = "articol";
                                }
                                $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Echipament lipsa: " . $team->raidmontan_participations->missing_equipment_items . " " . $missing_equipment_items_name . " x " . $raid_montan_per_missing_item . " puncte = " . $teams_raidmontan_list[$team->id]['missing_equipment_items_total'] . " puncte penalizare";
                            }
                            
                            if( $team->raidmontan_participations->minimum_distance_penalty == 1){
                                $teams_raidmontan_list[$team->id]['minimum_distance_penalty_total'] = $raid_montan_penality_minumum_distance;
                                $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Penalizare nerespectare distanta minima membrii: " . $raid_montan_penality_minumum_distance . " puncte";
                            } else {
                                $teams_raidmontan_list[$team->id]['minimum_distance_penalty_total'] = 0;
                            }
    
                            $key_count = 0;
                            foreach($team->raidmontan_participations_entries as $key => $participation_entries) {
                                $raidmontan_stations = RaidmontanStations::where('id', $participation_entries->raidmontan_stations_id)->first();
                                if($participation_entries->raidmontan_stations_station_type == 0){
                                    $teams_raidmontan_list[$participation_entries->team_id]['start'] = $participation_entries->time_start;
                                    $teams_raidmontan_list[$participation_entries->team_id]['start_in_seconds'] = strtotime($participation_entries->time_start);
                                } elseif($participation_entries->raidmontan_stations_station_type == 1) {
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['name'] = "PA " . $pa_count;
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time'] = $participation_entries->time_start;
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_start'] = strtotime($participation_entries->time_start);
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_finish'] = strtotime($participation_entries->time_finish);
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'] = strtotime($participation_entries->time_finish) - strtotime($participation_entries->time_start);
                                        $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['maximum_time_minutes'] = $raidmontan_stations->maximum_time;
                                        $pa_pause_seconds += $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'];
                                        
                                    $pa_count++;
                                    $key_count++;
                                } elseif($participation_entries->raidmontan_stations_station_type == 2){
                                    if($participation_entries->hits == 0){
                                        $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                        $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = $raidmontan_stations->points;
                                        $teams_raidmontan_list[$team->id]['pfa_depunctuation_total'] += $raidmontan_stations->points;
                                        $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Penalizare ratare " . $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][0] . " cu " . $raidmontan_stations->points . " puncte";
                                    } else {
                                        $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                        $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = 0;
                                    }
                                    $hits_count++;
                                } elseif($participation_entries->raidmontan_stations_station_type == 3){
                                    $teams_raidmontan_list[$participation_entries->team_id]['finish'] = $participation_entries->time_finish;
                                    $teams_raidmontan_list[$participation_entries->team_id]['finish_in_seconds'] = strtotime($participation_entries->time_finish);
                                    $teams_raidmontan_list[$participation_entries->team_id]['finish_maximum_time_minutes'] = $raidmontan_stations->maximum_time;    
                                    $teams_raidmontan_list[$participation_entries->team_id]['total_in_seconds'] = $teams_raidmontan_list[$participation_entries->team_id]['finish_in_seconds'] - $teams_raidmontan_list[$participation_entries->team_id]['start_in_seconds'] - $pa_pause_seconds;
                                    $teams_raidmontan_list[$participation_entries->team_id]['total_time'] = gmdate("H:i:s", $teams_raidmontan_list[$participation_entries->team_id]['total_in_seconds']);
                                } else {
                                    continue;
                                }
                            }
    
                            $pa_pause_seconds = 0;
    
                        } elseif($team->raidmontan_participations->abandon == 2 || $team->raidmontan_participations->missing_footwear == 1) {
                            $teams_raidmontan_list_disqualified[$key]['name'] = $team->name;
                            $teams_raidmontan_list_disqualified[$key]['total_time'] = "00:00:00";
                            $teams_raidmontan_list_disqualified[$key]['abandon'] = 2;
                        } else {
                            $teams_raidmontan_list_abandon[$key]['name'] = $team->name;
                            $teams_raidmontan_list_abandon[$key]['total_time'] = "00:00:00";
                            $teams_raidmontan_list_abandon[$key]['abandon'] = 1;
                        }
                    }
                }
    
                foreach($teams_raidmontan_list as $team_list_key => $team_list){
                    
                    $total_depunctuation_minutes = 0;
                    // dd($team_list);
                    // dd($team_list['pa']);
                    $pa_list = array_values($team_list['pa']);
                    $pa_count = count($team_list['pa']) - 1;
                    foreach($pa_list as $team_raidmontan_key => $team_raidmontan){

                        $time_start = $team_raidmontan['time_start'];
                        $time_finish = $team_raidmontan['time_finish'];
                        $time_pause_seconds = $team_raidmontan['time_pause_seconds'];
                        $maximum_time_minutes = $team_raidmontan['maximum_time_minutes'];

                        if ($team_raidmontan_key == 0) {
                            $depunctuation_minutes = ((int)round((($time_start - $team_list['start_in_seconds']) / 60))) - $maximum_time_minutes;
                            if ($depunctuation_minutes <= 0){
                                $depunctuation_minutes = 0;
                            } else {
                                $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes . " minute";
                            }
                            $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes;
                            $total_depunctuation_minutes += $depunctuation_minutes;
                            // var_dump($depunctuation_minutes);                           
                        } elseif ($team_raidmontan_key == $pa_count) {

                            $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;

                            if ($depunctuation_minutes_pa <= 0){
                                $depunctuation_minutes_pa = 0;
                            } else {
                                $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                            }
    
                            $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                            // var_dump($depunctuation_minutes_pa);
                            $total_depunctuation_minutes += $depunctuation_minutes_pa;
    
                            $depunctuation_minutes_finish = ((int)round((($team_list['finish_in_seconds'] - $time_finish ) / 60))) - $team_list['finish_maximum_time_minutes'];
                            if ($depunctuation_minutes_finish < 0){
                                $depunctuation_minutes_finish = 0;
                            }
    
                            if($depunctuation_minutes_finish > 0){
                                $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim F cu " . $depunctuation_minutes_finish . " minute";
                            }
                            $teams_raidmontan_list[$team_list_key]['total_finish_depunctuation_minutes'] = $depunctuation_minutes_finish;
                            // var_dump($depunctuation_minutes_finish);
                            $total_depunctuation_minutes += $depunctuation_minutes_finish;
                            
                        } else {                                
                            $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;                                

                            if ($depunctuation_minutes_pa <= 0){
                                $depunctuation_minutes_pa = 0;
                            } else {
                                $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                            }
                            $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                            $total_depunctuation_minutes += $depunctuation_minutes_pa;
                        }
                    }

                    $teams_raidmontan_list[$team_list_key]['total_depunctuation_minutes'] = $total_depunctuation_minutes;
                    $teams_raidmontan_list[$team_list_key]['total_score'] = $raid_montan_score_initial - $teams_raidmontan_list[$team_list_key]['pfa_depunctuation_total'] - ( $total_depunctuation_minutes * $raid_montan_penality_per_minute ) - $teams_raidmontan_list[$team_list_key]['minimum_distance_penalty_total'] - $teams_raidmontan_list[$team_list_key]['missing_equipment_items_total'];
                    $total_depunctuation_minutes = 0;

                }

            }


            $ranking_general = [];
            foreach($teams as $key1 => $team) {

                $ranking_general[$team->id]['name'] = $team->name;
                $ranking_general[$team->id]['scor_knowledge'] = 0;
                $ranking_general[$team->id]['scor_orienteering'] = 0;
                $ranking_general[$team->id]['scor_raidmontan'] = 0;
                $ranking_general[$team->id]['scor_total'] = 0;

                foreach($teams_raidmontan_list as $key2 => $raidmontan){
                    if($team->name == $raidmontan['name']){
                        $ranking_general[$team->id]['scor_raidmontan'] = $raidmontan['total_score'];
                        $ranking_general[$team->id]['scor_total'] += $raidmontan['total_score'];
                    }
                }

                foreach($teams_knowledge_list as $key2 => $knowledge){
                    if($team->name == $knowledge['name']){
                        $ranking_general[$team->id]['scor_knowledge'] = $knowledge['scor'];
                        $ranking_general[$team->id]['scor_total'] += $knowledge['scor'];
                    }
                }

                foreach($teams_orienteering_list as $key2 => $orienteering){
                    if($team->name == $orienteering['name']){
                        $ranking_general[$team->id]['scor_orienteering'] = $orienteering['scor'];
                        $ranking_general[$team->id]['scor_total'] += $orienteering['scor'];
                    }
                }
            }

            $ranking_general = collect($ranking_general);
            $ranking_general = $ranking_general->sortBy([
                ['scor_total', 'desc'],
            ]);

            // convert to array + reindex array key to be from 0 to ...
            $ranking_general  = array_values($ranking_general->toArray());

            // rank
            $x = 1;
            $unique_id = 0;

            foreach($ranking_general as $key => $team){
                $decrease_rank = 0;
                $ranking_general[$key]['rank'] = $x;
                    if(isset($ranking_general[$key-1]))
                    {
                        if($team['scor_total'] == $ranking_general[$key-1]['scor_total'] && $team['scor_total'] == $ranking_general[$key-1]['scor_total'])
                        {
                            $decrease_rank = 1;
                            $ranking_general[$key]['rank'] = $x-1;
                        }
                    }   
    
                if($decrease_rank == 0)
                {
                    $x++;
                }
    
                $unique_id++;
            }

            // Score Stafeta
            $initial_scor = 500;
            foreach($ranking_general as $key => $rank){
                if($rank['scor_raidmontan'] == 0){
                    $ranking_general[$key]['scor_stafeta'] = 0;
                }
                elseif($rank['scor_total'] == 0){
                    $ranking_general[$key]['scor_stafeta'] = 0;
                    $ranking_general[$key]['rank'] = "-";
                }
                elseif($rank['rank'] == 1){
                    $initial_scor = $initial_scor;
                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;

                } elseif($rank['rank'] == 2){
                    $initial_scor = $initial_scor - 20;
                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;

                } elseif($rank['rank'] == $ranking_general[$key-1]['rank']){

                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;

                } else {

                    $initial_scor = $initial_scor - 10;

                    // if $initial_sco is -10... set scor 0
                    if($initial_scor < 0){
                        $ranking_general[$key]['scor_stafeta'] = 0;
                    } else {
                        $ranking_general[$key]['scor_stafeta'] = $initial_scor;
                    }

                }
            }

            $pdf = PDF::loadView('rankings.general_category_pdf', ['ranking_general' => $ranking_general, 'category' => $category]);
            $pdf->setPaper('A4', 'landscape');
            $general_category_pdf = 'rankings.general_category_pdf';
            return $pdf->stream($general_category_pdf);

    }



    public function ranking_cumulat()
    {

        $clubs = Club::with('teams')->get();

        // $category = Category::FindOrFail($category_id);

        $list_clubs = [];

            $categories = Category::get();

            foreach($categories as $category){

    
                // rank for knowledge
                $teams_knowledge = Team::with('knowledge')->where('category_id', $category->id)->get();
        
                    $teams_knowledge_list = [];
                    foreach($teams_knowledge as $key => $team){
                        if($team->knowledge == null){
                            $notification = array(
                                'success_title' => 'Eroare!!',
                                'message' => 'Datele nu pot fi generate, echipa ' . $team->name . ' nu are datele completate in categoria ' . $category->name . ", proba Teste Teoretice.",
                                'alert-type' => 'error'
                            );
                            return redirect()->route('knowledge.index', $category->id)->with($notification);
                        } else {
                            if($team->knowledge->abandon == 0){
                                $teams_knowledge_list[$key]['name'] = $team->name;
                                $teams_knowledge_list[$key]['scor'] = $team->knowledge->scor;
                                $teams_knowledge_list[$key]['abandon'] = $team->knowledge->abandon;
                            } elseif($team->knowledge->abandon == 1) {
                                $teams_knowledge_list[$key]['name'] = $team->name;
                                $teams_knowledge_list[$key]['scor'] = 0;
                                $teams_knowledge_list[$key]['abandon'] = 1;
                            } else {
                                $teams_knowledge_list[$key]['name'] = $team->name;
                                $teams_knowledge_list[$key]['scor'] = 0;
                                $teams_knowledge_list[$key]['abandon'] = 2;
                            }
                        }
                    }
                
                // rank for orienteering

                $teams_orienteering = Team::with('orienteering')->where('category_id', $category->id)->get();
                
                    $teams_orienteering_list = [];
                    foreach($teams_orienteering as $key => $team){
                        if($team->orienteering == null){
                            $notification = array(
                                'success_title' => 'Eroare!!',
                                'message' => 'Datele nu pot fi generate, echipa ' . $team->name . ' nu are datele completate in categoria ' . $category->name . ", proba Orientare.",
                                'alert-type' => 'error'
                            );
                            return redirect()->route('orienteering.index', $category->id)->with($notification);
                        } else {
                            $order_posts_result = "";
                            if($team->orienteering->abandon == 0){
                                $teams_orienteering_list[$key]['name'] = $team->name;
                                $teams_orienteering_list[$key]['abandon'] = $team->orienteering->abandon;
                                $teams_orienteering_list[$key]['total_time'] = $team->orienteering->total_time;
                                // convert into a timestamp
                                $teams_orienteering_list[$key]['total_time_seconds'] = strtotime($team->orienteering->total_time);
                            }
                        }
                    }

                        $collection_orienteering = collect($teams_orienteering_list);
                        $collection_orienteering = $collection_orienteering->sortBy([
                            ['total_time', 'asc'],
                        ]);

                        // convert to array + reindex array key to be from 0 to ...
                        $collection_orienteering  = array_values($collection_orienteering->toArray());

                        // dd($collection_orienteering[1]["total_time_seconds"] - $collection_orienteering[0]["total_time_seconds"]);

                        foreach($collection_orienteering as $key => $orienteering){
                            if($key == 0){
                                $collection_orienteering[$key]['scor'] = 5000;
                            } else {
                                $seconds = $orienteering['total_time_seconds'];
                                $difference = isset($seconds) ?
                                    $seconds - $collection_orienteering[0]["total_time_seconds"] :
                                    0;
                                $score = isset($difference) ?
                                    5000 - $difference :
                                    5000;
                                $collection_orienteering[$key]['scor'] = $score;
                            }
                        }

                    $teams_orienteering_list = $collection_orienteering;



                    // rank for raid montan

                    $teams_raidmontan = Team::with('raidmontan_participations')->with('raidmontan_participations_entries')->where('category_id', $category->id)->get();
            
                        // raidmontan score/penality 
                        $raid_montan_score_initial = 10000;
                        $raid_montan_penality_per_minute = 10;
                        $raid_montan_per_missing_item = 5;
                        $raid_montan_penality_minumum_distance = 300;
            
                        $teams_raidmontan_list = [];
                        $teams_raidmontan_list_abandon = [];
                        $teams_raidmontan_list_disqualified = [];
                        $pa_pause_seconds = 0;
            
                        foreach($teams_raidmontan as $key => $team){

                            if($team->raidmontan_participations == null){
                                $notification = array(
                                    'success_title' => 'Eroare!!',
                                    'message' => 'Datele nu pot fi generate, echipa ' . $team->name . ' nu are datele completate in categoria ' . $category->name . ", proba Raid Montan.",
                                    'alert-type' => 'error'
                                );
                                return redirect()->route('raidmontan.index', $category->id)->with($notification);
                            }

                            $hits_count = 1;
                            $pa_count = 1;
                            if($team->raidmontan_participations == null){
                                continue;
                            } else {
                                if($team->raidmontan_participations->abandon == 0 && $team->raidmontan_participations->missing_footwear == 0){
                                    $teams_raidmontan_list[$team->id]['name'] = $team->name;
                                    $teams_raidmontan_list[$team->id]['abandon'] = 0;
                                    $teams_raidmontan_list[$team->id]['pfa_depunctuation_total'] = 0;
                                    $teams_raidmontan_list[$team->id]['missing_equipment_items_total'] = $raid_montan_per_missing_item * $team->raidmontan_participations->missing_equipment_items;
            
                                    if($teams_raidmontan_list[$team->id]['missing_equipment_items_total'] !== 0){
                                        if($teams_raidmontan_list[$team->id]['missing_equipment_items_total'] > 1){
                                            $missing_equipment_items_name = "articole";
                                        } else {
                                            $missing_equipment_items_name = "articol";
                                        }
                                        $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Echipament lipsa: " . $team->raidmontan_participations->missing_equipment_items . " " . $missing_equipment_items_name . " x " . $raid_montan_per_missing_item . " puncte = " . $teams_raidmontan_list[$team->id]['missing_equipment_items_total'] . " puncte penalizare";
                                    }
                                    
                                    if( $team->raidmontan_participations->minimum_distance_penalty == 1){
                                        $teams_raidmontan_list[$team->id]['minimum_distance_penalty_total'] = $raid_montan_penality_minumum_distance;
                                        $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Penalizare nerespectare distanta minima membrii: " . $raid_montan_penality_minumum_distance . " puncte";
                                    } else {
                                        $teams_raidmontan_list[$team->id]['minimum_distance_penalty_total'] = 0;
                                    }
            
                                    $key_count = 0;
                                    foreach($team->raidmontan_participations_entries as $key => $participation_entries) {
                                        $raidmontan_stations = RaidmontanStations::where('id', $participation_entries->raidmontan_stations_id)->first();
                                        if($participation_entries->raidmontan_stations_station_type == 0){
                                            $teams_raidmontan_list[$participation_entries->team_id]['start'] = $participation_entries->time_start;
                                            $teams_raidmontan_list[$participation_entries->team_id]['start_in_seconds'] = strtotime($participation_entries->time_start);
                                        } elseif($participation_entries->raidmontan_stations_station_type == 1) {
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['name'] = "PA " . $pa_count;
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time'] = $participation_entries->time_start;
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_start'] = strtotime($participation_entries->time_start);
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_finish'] = strtotime($participation_entries->time_finish);
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'] = strtotime($participation_entries->time_finish) - strtotime($participation_entries->time_start);
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['maximum_time_minutes'] = $raidmontan_stations->maximum_time;
                                                $pa_pause_seconds += $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'];
                                                
                                            $pa_count++;
                                            $key_count++;
                                        } elseif($participation_entries->raidmontan_stations_station_type == 2){
                                            if($participation_entries->hits == 0){
                                                $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                                $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = $raidmontan_stations->points;
                                                $teams_raidmontan_list[$team->id]['pfa_depunctuation_total'] += $raidmontan_stations->points;
                                                $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Penalizare ratare " . $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][0] . " cu " . $raidmontan_stations->points . " puncte";
                                            } else {
                                                $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                                $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = 0;
                                            }
                                            $hits_count++;
                                        } elseif($participation_entries->raidmontan_stations_station_type == 3){
                                            $teams_raidmontan_list[$participation_entries->team_id]['finish'] = $participation_entries->time_finish;
                                            $teams_raidmontan_list[$participation_entries->team_id]['finish_in_seconds'] = strtotime($participation_entries->time_finish);
                                            $teams_raidmontan_list[$participation_entries->team_id]['finish_maximum_time_minutes'] = $raidmontan_stations->maximum_time;    
                                            $teams_raidmontan_list[$participation_entries->team_id]['total_in_seconds'] = $teams_raidmontan_list[$participation_entries->team_id]['finish_in_seconds'] - $teams_raidmontan_list[$participation_entries->team_id]['start_in_seconds'] - $pa_pause_seconds;
                                            $teams_raidmontan_list[$participation_entries->team_id]['total_time'] = gmdate("H:i:s", $teams_raidmontan_list[$participation_entries->team_id]['total_in_seconds']);
                                        } else {
                                            continue;
                                        }
                                    }
            
                                    $pa_pause_seconds = 0;
            
                                } elseif($team->raidmontan_participations->abandon == 2 || $team->raidmontan_participations->missing_footwear == 1) {
                                    $teams_raidmontan_list_disqualified[$key]['name'] = $team->name;
                                    $teams_raidmontan_list_disqualified[$key]['total_time'] = "00:00:00";
                                    $teams_raidmontan_list_disqualified[$key]['abandon'] = 2;
                                } else {
                                    $teams_raidmontan_list_abandon[$key]['name'] = $team->name;
                                    $teams_raidmontan_list_abandon[$key]['total_time'] = "00:00:00";
                                    $teams_raidmontan_list_abandon[$key]['abandon'] = 1;
                                }
                            }
                        }
            
                        foreach($teams_raidmontan_list as $team_list_key => $team_list){
                    
                            $total_depunctuation_minutes = 0;
                            // dd($team_list);
                            // dd($team_list['pa']);
                            $pa_list = array_values($team_list['pa']);
                            $pa_count = count($team_list['pa']) - 1;
                            foreach($pa_list as $team_raidmontan_key => $team_raidmontan){
        
                                $time_start = $team_raidmontan['time_start'];
                                $time_finish = $team_raidmontan['time_finish'];
                                $time_pause_seconds = $team_raidmontan['time_pause_seconds'];
                                $maximum_time_minutes = $team_raidmontan['maximum_time_minutes'];
        
                                if ($team_raidmontan_key == 0) {
                                    $depunctuation_minutes = ((int)round((($time_start - $team_list['start_in_seconds']) / 60))) - $maximum_time_minutes;
                                    if ($depunctuation_minutes <= 0){
                                        $depunctuation_minutes = 0;
                                    } else {
                                        $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes . " minute";
                                    }
                                    $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes;
                                    $total_depunctuation_minutes += $depunctuation_minutes;
                                    // var_dump($depunctuation_minutes);                           
                                } elseif ($team_raidmontan_key == $pa_count) {
    
                                    $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;
        
                                    if ($depunctuation_minutes_pa <= 0){
                                        $depunctuation_minutes_pa = 0;
                                    } else {
                                        $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                                    }
            
                                    $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                                    // var_dump($depunctuation_minutes_pa);
                                    $total_depunctuation_minutes += $depunctuation_minutes_pa;
            
                                    $depunctuation_minutes_finish = ((int)round((($team_list['finish_in_seconds'] - $time_finish ) / 60))) - $team_list['finish_maximum_time_minutes'];
                                    if ($depunctuation_minutes_finish < 0){
                                        $depunctuation_minutes_finish = 0;
                                    }
            
                                    if($depunctuation_minutes_finish > 0){
                                        $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim F cu " . $depunctuation_minutes_finish . " minute";
                                    }
                                    $teams_raidmontan_list[$team_list_key]['total_finish_depunctuation_minutes'] = $depunctuation_minutes_finish;
                                    // var_dump($depunctuation_minutes_finish);
                                    $total_depunctuation_minutes += $depunctuation_minutes_finish;
                                    
                                } else {                                
                                    $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;                                
        
                                    if ($depunctuation_minutes_pa <= 0){
                                        $depunctuation_minutes_pa = 0;
                                    } else {
                                        $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                                    }
                                    $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                                    $total_depunctuation_minutes += $depunctuation_minutes_pa;
                                }
                            }
        
                            $teams_raidmontan_list[$team_list_key]['total_depunctuation_minutes'] = $total_depunctuation_minutes;
                            $teams_raidmontan_list[$team_list_key]['total_score'] = $raid_montan_score_initial - $teams_raidmontan_list[$team_list_key]['pfa_depunctuation_total'] - ( $total_depunctuation_minutes * $raid_montan_penality_per_minute ) - $teams_raidmontan_list[$team_list_key]['minimum_distance_penalty_total'] - $teams_raidmontan_list[$team_list_key]['missing_equipment_items_total'];
                            $total_depunctuation_minutes = 0;
    
                        }


                            $teams = Team::where('category_id', $category->id)->get();
                            $ranking_general = [];
                            foreach($teams as $key1 => $team) {
                
                                $ranking_general[$team->id]['name'] = $team->name;
                                $ranking_general[$team->id]['scor_knowledge'] = 0;
                                $ranking_general[$team->id]['scor_orienteering'] = 0;
                                $ranking_general[$team->id]['scor_raidmontan'] = 0;
                                $ranking_general[$team->id]['scor_total'] = 0;
                
                                foreach($teams_raidmontan_list as $key2 => $raidmontan){
                                    if($team->name == $raidmontan['name']){
                                        $ranking_general[$team->id]['scor_raidmontan'] = $raidmontan['total_score'];
                                        $ranking_general[$team->id]['scor_total'] += $raidmontan['total_score'];
                                    }
                                }
                
                                foreach($teams_knowledge_list as $key2 => $knowledge){
                                    if($team->name == $knowledge['name']){
                                        $ranking_general[$team->id]['scor_knowledge'] = $knowledge['scor'];
                                        $ranking_general[$team->id]['scor_total'] += $knowledge['scor'];
                                    }
                                }
                
                                foreach($teams_orienteering_list as $key2 => $orienteering){
                                    if($team->name == $orienteering['name']){
                                        $ranking_general[$team->id]['scor_orienteering'] = $orienteering['scor'];
                                        $ranking_general[$team->id]['scor_total'] += $orienteering['scor'];
                                    }
                                }
                            }
                
                            $ranking_general = collect($ranking_general);
                            $ranking_general = $ranking_general->sortBy([
                                ['scor_total', 'desc'],
                            ]);
                
                            // convert to array + reindex array key to be from 0 to ...
                            $ranking_general  = array_values($ranking_general->toArray());
                
                            // rank
                            $x = 1;
                            $unique_id = 0;
                
                            foreach($ranking_general as $key => $team){
                                $decrease_rank = 0;
                                $ranking_general[$key]['rank'] = $x;
                                    if(isset($ranking_general[$key-1]))
                                    {
                                        if($team['scor_total'] == $ranking_general[$key-1]['scor_total'] && $team['scor_total'] == $ranking_general[$key-1]['scor_total'])
                                        {
                                            $decrease_rank = 1;
                                            $ranking_general[$key]['rank'] = $x-1;
                                        }
                                    }   
                    
                                if($decrease_rank == 0)
                                {
                                    $x++;
                                }
                    
                                $unique_id++;
                            }
                
                            // Score Stafeta
                            $initial_scor = 500;
                            foreach($ranking_general as $key => $rank){
                                if($rank['scor_raidmontan'] == 0){
                                    $ranking_general[$key]['scor_stafeta'] = 0;
                                }
                                elseif($rank['scor_total'] == 0){
                                    $ranking_general[$key]['scor_stafeta'] = 0;
                                    $ranking_general[$key]['rank'] = "-";
                                }
                                elseif($rank['rank'] == 1){
                                    $initial_scor = $initial_scor;
                                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;
                
                                } elseif($rank['rank'] == 2){
                                    $initial_scor = $initial_scor - 20;
                                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;
                
                                } elseif($rank['rank'] == $ranking_general[$key-1]['rank']){
                
                                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;
                
                                } else {
                
                                    $initial_scor = $initial_scor - 10;

                                    // if $initial_sco is -10... set scor 0
                                    if($initial_scor < 0){
                                        $ranking_general[$key]['scor_stafeta'] = 0;
                                    } else {
                                        $ranking_general[$key]['scor_stafeta'] = $initial_scor;
                                    }
                
                                }
                            }

                            // add clasament in clubs
                            foreach($clubs as $key_club => $club){
                                foreach($club->teams as $key_team => $team){
                                    // scor stafeta
                                    foreach($ranking_general as $general_team_category){
                                        if($team->name == $general_team_category['name']){
                                            $list_clubs[$club->name][$category->name][] = $general_team_category['scor_stafeta'];
                                        }
                                    }
                                }

                            }
            }


        // check if bonus is present Articolul 12 - 12.2 - c.
        foreach($clubs as $club){
            $list_clubs[$club->name]['bonus'] = 0;
            foreach($club->teams as $team){

            $knowledge_bonus = Knowledge::where('team_id', $team->id)->whereIn('abandon', [0,2])->count();
            $orienteering_bonus = Orienteering::where('team_id', $team->id)->whereIn('abandon', [0,2])->count();
            $raidmontanparticipations_bonus = RaidmontanParticipations::where('team_id', $team->id)->whereIn('abandon', [0,2])->count();

                if($knowledge_bonus == 1 && $orienteering_bonus == 1 && $raidmontanparticipations_bonus == 1){
                    $list_clubs[$club->name]['bonus'] += 10;
                }
            }
        }

  

        $rankings = [];
        foreach($list_clubs as $club_key => $club){
            $rankings[$club_key]['bonus'] = $club['bonus'];
            // start with bonus total_sm
            $rankings[$club_key]['total_sm'] = $club['bonus'];
            $rankings[$club_key]['club_name'] = $club_key;
            foreach($categories as $category){
                if(isset($list_clubs[$club_key][$category->name])){
                    $collection = collect($club[$category->name]);
                    $collection = $collection->sortDesc();
                    $collection = $collection->toArray();
                    $collection = array_values($collection);
                    $rankings[$club_key][$category->name] = $collection[0];
                    // $rankings[$club_key]['total_sm'] += $collection[0];
                    $rankings[$club_key]['categories'][$category->name] = $collection[0];

                } else {
                    $rankings[$club_key][$category->name] = 0;
                    // $rankings[$club_key]['total_sm'] += 0;
                    $rankings[$club_key]['categories'][$category->name] = 0;
                }

            }

            $coll = collect($rankings[$club_key]['categories']);
            $coll = $coll->sortDesc();
            $rankings[$club_key]['categories'] = $coll->toArray();

            $count = 1;
            foreach($rankings[$club_key]['categories'] as $category){
                if($count <= 4){

                    $rankings[$club_key]['total_sm'] += $category;
                    $count++;
                }
            }

            
        }


        // reset array key in order to do rank
        // dd($rankings);
        $rankings = array_values($rankings);


        // order by total_sm desc
        $rankings = collect($rankings);
        $rankings = $rankings->sortBy([
            ['total_sm', 'desc'],
        ]);

        // convert to array + reindex array key to be from 0 to ...
        $rankings  = array_values($rankings->toArray());

        // rank
        $x = 1;
        $unique_id = 0;

    
        
        foreach($rankings as $key => $team){
            $decrease_rank = 0;
            $rankings[$key]['rank'] = $x;
                if(isset($rankings[$key-1]))
                {
                    if($team['total_sm'] == $rankings[$key-1]['total_sm'] && $team['total_sm'] == $rankings[$key-1]['total_sm'])
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

        // dd($rankings);
        return view('rankings.general',compact('rankings','categories'));


    }


    public function ranking_cumulat_pdf()
    {

        $clubs = Club::with('teams')->get();

        // $category = Category::FindOrFail($category_id);

        $list_clubs = [];

            $categories = Category::get();

            foreach($categories as $category){

    
                // rank for knowledge
                $teams_knowledge = Team::with('knowledge')->where('category_id', $category->id)->get();
        
                    $teams_knowledge_list = [];
                    foreach($teams_knowledge as $key => $team){
                        if($team->knowledge == null){
                            $notification = array(
                                'success_title' => 'Eroare!!',
                                'message' => 'Datele nu pot fi generate, echipa ' . $team->name . ' nu are datele completate in categoria ' . $category->name . ", proba Teste Teoretice.",
                                'alert-type' => 'error'
                            );
                            return redirect()->route('knowledge.index', $category->id)->with($notification);
                        } else {
                            if($team->knowledge->abandon == 0){
                                $teams_knowledge_list[$key]['name'] = $team->name;
                                $teams_knowledge_list[$key]['scor'] = $team->knowledge->scor;
                                $teams_knowledge_list[$key]['abandon'] = $team->knowledge->abandon;
                            } elseif($team->knowledge->abandon == 1) {
                                $teams_knowledge_list[$key]['name'] = $team->name;
                                $teams_knowledge_list[$key]['scor'] = 0;
                                $teams_knowledge_list[$key]['abandon'] = 1;
                            } else {
                                $teams_knowledge_list[$key]['name'] = $team->name;
                                $teams_knowledge_list[$key]['scor'] = 0;
                                $teams_knowledge_list[$key]['abandon'] = 2;
                            }
                        }
                    }
                
                // rank for orienteering

                $teams_orienteering = Team::with('orienteering')->where('category_id', $category->id)->get();
                
                    $teams_orienteering_list = [];
                    foreach($teams_orienteering as $key => $team){
                        if($team->orienteering == null){
                            $notification = array(
                                'success_title' => 'Eroare!!',
                                'message' => 'Datele nu pot fi generate, echipa ' . $team->name . ' nu are datele completate in categoria ' . $category->name . ", proba Orientare.",
                                'alert-type' => 'error'
                            );
                            return redirect()->route('orienteering.index', $category->id)->with($notification);
                        } else {
                            $order_posts_result = "";
                            if($team->orienteering->abandon == 0){
                                $teams_orienteering_list[$key]['name'] = $team->name;
                                $teams_orienteering_list[$key]['abandon'] = $team->orienteering->abandon;
                                $teams_orienteering_list[$key]['total_time'] = $team->orienteering->total_time;
                                // convert into a timestamp
                                $teams_orienteering_list[$key]['total_time_seconds'] = strtotime($team->orienteering->total_time);
                            }
                        }
                    }


                        $collection_orienteering = collect($teams_orienteering_list);
                        $collection_orienteering = $collection_orienteering->sortBy([
                            ['total_time', 'asc'],
                        ]);

                        // convert to array + reindex array key to be from 0 to ...
                        $collection_orienteering  = array_values($collection_orienteering->toArray());

                        // dd($collection_orienteering[1]["total_time_seconds"] - $collection_orienteering[0]["total_time_seconds"]);

                        foreach($collection_orienteering as $key => $orienteering){
                            if($key == 0){
                                $collection_orienteering[$key]['scor'] = 5000;
                            } else {
                                $seconds = $orienteering['total_time_seconds'];
                                $difference = isset($seconds) ?
                                    $seconds - $collection_orienteering[0]["total_time_seconds"] :
                                    0;
                                $score = isset($difference) ?
                                    5000 - $difference :
                                    5000;
                                $collection_orienteering[$key]['scor'] = $score;
                            }
                        }

                    $teams_orienteering_list = $collection_orienteering;



                    // rank for raid montan

                    $teams_raidmontan = Team::with('raidmontan_participations')->with('raidmontan_participations_entries')->where('category_id', $category->id)->get();
            
                        // raidmontan score/penality 
                        $raid_montan_score_initial = 10000;
                        $raid_montan_penality_per_minute = 10;
                        $raid_montan_per_missing_item = 5;
                        $raid_montan_penality_minumum_distance = 300;
            
                        $teams_raidmontan_list = [];
                        $teams_raidmontan_list_abandon = [];
                        $teams_raidmontan_list_disqualified = [];
                        $pa_pause_seconds = 0;
            
                        foreach($teams_raidmontan as $key => $team){


                            if($team->raidmontan_participations == null){
                                $notification = array(
                                    'success_title' => 'Eroare!!',
                                    'message' => 'Datele nu pot fi generate, echipa ' . $team->name . ' nu are datele completate in categoria ' . $category->name . ", proba Raid Montan.",
                                    'alert-type' => 'error'
                                );
                                return redirect()->route('raidmontan.index', $category->id)->with($notification);
                            }

                            $hits_count = 1;
                            $pa_count = 1;
                            if($team->raidmontan_participations == null){
                                continue;
                            } else {
                                if($team->raidmontan_participations->abandon == 0 && $team->raidmontan_participations->missing_footwear == 0){
                                    $teams_raidmontan_list[$team->id]['name'] = $team->name;
                                    $teams_raidmontan_list[$team->id]['abandon'] = 0;
                                    $teams_raidmontan_list[$team->id]['pfa_depunctuation_total'] = 0;
                                    $teams_raidmontan_list[$team->id]['missing_equipment_items_total'] = $raid_montan_per_missing_item * $team->raidmontan_participations->missing_equipment_items;
            
                                    if($teams_raidmontan_list[$team->id]['missing_equipment_items_total'] !== 0){
                                        if($teams_raidmontan_list[$team->id]['missing_equipment_items_total'] > 1){
                                            $missing_equipment_items_name = "articole";
                                        } else {
                                            $missing_equipment_items_name = "articol";
                                        }
                                        $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Echipament lipsa: " . $team->raidmontan_participations->missing_equipment_items . " " . $missing_equipment_items_name . " x " . $raid_montan_per_missing_item . " puncte = " . $teams_raidmontan_list[$team->id]['missing_equipment_items_total'] . " puncte penalizare";
                                    }
                                    
                                    if( $team->raidmontan_participations->minimum_distance_penalty == 1){
                                        $teams_raidmontan_list[$team->id]['minimum_distance_penalty_total'] = $raid_montan_penality_minumum_distance;
                                        $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Penalizare nerespectare distanta minima membrii: " . $raid_montan_penality_minumum_distance . " puncte";
                                    } else {
                                        $teams_raidmontan_list[$team->id]['minimum_distance_penalty_total'] = 0;
                                    }
            
                                    $key_count = 0;
                                    foreach($team->raidmontan_participations_entries as $key => $participation_entries) {
                                        $raidmontan_stations = RaidmontanStations::where('id', $participation_entries->raidmontan_stations_id)->first();
                                        if($participation_entries->raidmontan_stations_station_type == 0){
                                            $teams_raidmontan_list[$participation_entries->team_id]['start'] = $participation_entries->time_start;
                                            $teams_raidmontan_list[$participation_entries->team_id]['start_in_seconds'] = strtotime($participation_entries->time_start);
                                        } elseif($participation_entries->raidmontan_stations_station_type == 1) {
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['name'] = "PA " . $pa_count;
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time'] = $participation_entries->time_start;
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_start'] = strtotime($participation_entries->time_start);
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_finish'] = strtotime($participation_entries->time_finish);
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'] = strtotime($participation_entries->time_finish) - strtotime($participation_entries->time_start);
                                                $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['maximum_time_minutes'] = $raidmontan_stations->maximum_time;
                                                $pa_pause_seconds += $teams_raidmontan_list[$participation_entries->team_id]['pa'][$key_count]['time_pause_seconds'];
                                                
                                            $pa_count++;
                                            $key_count++;
                                        } elseif($participation_entries->raidmontan_stations_station_type == 2){
                                            if($participation_entries->hits == 0){
                                                $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                                $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = $raidmontan_stations->points;
                                                $teams_raidmontan_list[$team->id]['pfa_depunctuation_total'] += $raidmontan_stations->points;
                                                $teams_raidmontan_list[$team->id]['depunctation_status'][] = "Penalizare ratare " . $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][0] . " cu " . $raidmontan_stations->points . " puncte";
                                            } else {
                                                $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = "PFA " . $hits_count;
                                                $teams_raidmontan_list[$participation_entries->team_id]['pfa_depunctuation'][$key][] = 0;
                                            }
                                            $hits_count++;
                                        } elseif($participation_entries->raidmontan_stations_station_type == 3){
                                            $teams_raidmontan_list[$participation_entries->team_id]['finish'] = $participation_entries->time_finish;
                                            $teams_raidmontan_list[$participation_entries->team_id]['finish_in_seconds'] = strtotime($participation_entries->time_finish);
                                            $teams_raidmontan_list[$participation_entries->team_id]['finish_maximum_time_minutes'] = $raidmontan_stations->maximum_time;    
                                            $teams_raidmontan_list[$participation_entries->team_id]['total_in_seconds'] = $teams_raidmontan_list[$participation_entries->team_id]['finish_in_seconds'] - $teams_raidmontan_list[$participation_entries->team_id]['start_in_seconds'] - $pa_pause_seconds;
                                            $teams_raidmontan_list[$participation_entries->team_id]['total_time'] = gmdate("H:i:s", $teams_raidmontan_list[$participation_entries->team_id]['total_in_seconds']);
                                        } else {
                                            continue;
                                        }
                                    }
            
                                    $pa_pause_seconds = 0;
            
                                } elseif($team->raidmontan_participations->abandon == 2 || $team->raidmontan_participations->missing_footwear == 1) {
                                    $teams_raidmontan_list_disqualified[$key]['name'] = $team->name;
                                    $teams_raidmontan_list_disqualified[$key]['total_time'] = "00:00:00";
                                    $teams_raidmontan_list_disqualified[$key]['abandon'] = 2;
                                } else {
                                    $teams_raidmontan_list_abandon[$key]['name'] = $team->name;
                                    $teams_raidmontan_list_abandon[$key]['total_time'] = "00:00:00";
                                    $teams_raidmontan_list_abandon[$key]['abandon'] = 1;
                                }
                            }
                        }
            
                        foreach($teams_raidmontan_list as $team_list_key => $team_list){
                    
                            $total_depunctuation_minutes = 0;
                            // dd($team_list);
                            // dd($team_list['pa']);
                            $pa_list = array_values($team_list['pa']);
                            $pa_count = count($team_list['pa']) - 1;
                            foreach($pa_list as $team_raidmontan_key => $team_raidmontan){
        
                                $time_start = $team_raidmontan['time_start'];
                                $time_finish = $team_raidmontan['time_finish'];
                                $time_pause_seconds = $team_raidmontan['time_pause_seconds'];
                                $maximum_time_minutes = $team_raidmontan['maximum_time_minutes'];
        
                                if ($team_raidmontan_key == 0) {
                                    $depunctuation_minutes = ((int)round((($time_start - $team_list['start_in_seconds']) / 60))) - $maximum_time_minutes;
                                    if ($depunctuation_minutes <= 0){
                                        $depunctuation_minutes = 0;
                                    } else {
                                        $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes . " minute";
                                    }
                                    $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes;
                                    $total_depunctuation_minutes += $depunctuation_minutes;
                                    // var_dump($depunctuation_minutes);                           
                                } elseif ($team_raidmontan_key == $pa_count) {
    
                                    $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;
        
                                    if ($depunctuation_minutes_pa <= 0){
                                        $depunctuation_minutes_pa = 0;
                                    } else {
                                        $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                                    }
            
                                    $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                                    // var_dump($depunctuation_minutes_pa);
                                    $total_depunctuation_minutes += $depunctuation_minutes_pa;
            
                                    $depunctuation_minutes_finish = ((int)round((($team_list['finish_in_seconds'] - $time_finish ) / 60))) - $team_list['finish_maximum_time_minutes'];
                                    if ($depunctuation_minutes_finish < 0){
                                        $depunctuation_minutes_finish = 0;
                                    }
            
                                    if($depunctuation_minutes_finish > 0){
                                        $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim F cu " . $depunctuation_minutes_finish . " minute";
                                    }
                                    $teams_raidmontan_list[$team_list_key]['total_finish_depunctuation_minutes'] = $depunctuation_minutes_finish;
                                    // var_dump($depunctuation_minutes_finish);
                                    $total_depunctuation_minutes += $depunctuation_minutes_finish;
                                    
                                } else {                                
                                    $depunctuation_minutes_pa = ((int)round((($time_start - $pa_list[$team_raidmontan_key-1]['time_finish']) / 60))) - $maximum_time_minutes;                                
        
                                    if ($depunctuation_minutes_pa <= 0){
                                        $depunctuation_minutes_pa = 0;
                                    } else {
                                        $teams_raidmontan_list[$team_list_key]['depunctation_status'][] = "Penalizare depasire timp maxim " .  $team_raidmontan['name'] . " cu " . $depunctuation_minutes_pa . " minute";
                                    }
                                    $teams_raidmontan_list[$team_list_key]['pa'][$team_raidmontan_key]['time_depunctuation_minutes'] = $depunctuation_minutes_pa;
                                    $total_depunctuation_minutes += $depunctuation_minutes_pa;
                                }
                            }
        
                            $teams_raidmontan_list[$team_list_key]['total_depunctuation_minutes'] = $total_depunctuation_minutes;
                            $teams_raidmontan_list[$team_list_key]['total_score'] = $raid_montan_score_initial - $teams_raidmontan_list[$team_list_key]['pfa_depunctuation_total'] - ( $total_depunctuation_minutes * $raid_montan_penality_per_minute ) - $teams_raidmontan_list[$team_list_key]['minimum_distance_penalty_total'] - $teams_raidmontan_list[$team_list_key]['missing_equipment_items_total'];
                            $total_depunctuation_minutes = 0;
    
                        }


                            $teams = Team::where('category_id', $category->id)->get();
                            $ranking_general = [];
                            foreach($teams as $key1 => $team) {
                
                                $ranking_general[$team->id]['name'] = $team->name;
                                $ranking_general[$team->id]['scor_knowledge'] = 0;
                                $ranking_general[$team->id]['scor_orienteering'] = 0;
                                $ranking_general[$team->id]['scor_raidmontan'] = 0;
                                $ranking_general[$team->id]['scor_total'] = 0;
                
                                foreach($teams_raidmontan_list as $key2 => $raidmontan){
                                    if($team->name == $raidmontan['name']){
                                        $ranking_general[$team->id]['scor_raidmontan'] = $raidmontan['total_score'];
                                        $ranking_general[$team->id]['scor_total'] += $raidmontan['total_score'];
                                    }
                                }
                
                                foreach($teams_knowledge_list as $key2 => $knowledge){
                                    if($team->name == $knowledge['name']){
                                        $ranking_general[$team->id]['scor_knowledge'] = $knowledge['scor'];
                                        $ranking_general[$team->id]['scor_total'] += $knowledge['scor'];
                                    }
                                }
                
                                foreach($teams_orienteering_list as $key2 => $orienteering){
                                    if($team->name == $orienteering['name']){
                                        $ranking_general[$team->id]['scor_orienteering'] = $orienteering['scor'];
                                        $ranking_general[$team->id]['scor_total'] += $orienteering['scor'];
                                    }
                                }
                            }
                
                            $ranking_general = collect($ranking_general);
                            $ranking_general = $ranking_general->sortBy([
                                ['scor_total', 'desc'],
                            ]);
                
                            // convert to array + reindex array key to be from 0 to ...
                            $ranking_general  = array_values($ranking_general->toArray());
                
                            // rank
                            $x = 1;
                            $unique_id = 0;
                
                            foreach($ranking_general as $key => $team){
                                $decrease_rank = 0;
                                $ranking_general[$key]['rank'] = $x;
                                    if(isset($ranking_general[$key-1]))
                                    {
                                        if($team['scor_total'] == $ranking_general[$key-1]['scor_total'] && $team['scor_total'] == $ranking_general[$key-1]['scor_total'])
                                        {
                                            $decrease_rank = 1;
                                            $ranking_general[$key]['rank'] = $x-1;
                                        }
                                    }   
                    
                                if($decrease_rank == 0)
                                {
                                    $x++;
                                }
                    
                                $unique_id++;
                            }
                
                            // Score Stafeta
                            $initial_scor = 500;
                            foreach($ranking_general as $key => $rank){
                                if($rank['scor_raidmontan'] == 0){
                                    $ranking_general[$key]['scor_stafeta'] = 0;
                                }
                                elseif($rank['scor_total'] == 0){
                                    $ranking_general[$key]['scor_stafeta'] = 0;
                                    $ranking_general[$key]['rank'] = "-";
                                }
                                elseif($rank['rank'] == 1){
                                    $initial_scor = $initial_scor;
                                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;
                
                                } elseif($rank['rank'] == 2){
                                    $initial_scor = $initial_scor - 20;
                                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;
                
                                } elseif($rank['rank'] == $ranking_general[$key-1]['rank']){
                
                                    $ranking_general[$key]['scor_stafeta'] = $initial_scor;
                
                                } else {
                
                                    $initial_scor = $initial_scor - 10;
                                    // if $initial_sco is -10... set scor 0
                                    if($initial_scor < 0){
                                        $ranking_general[$key]['scor_stafeta'] = 0;
                                    } else {
                                        $ranking_general[$key]['scor_stafeta'] = $initial_scor;
                                    }
                
                                }
                            }

                            // add clasament in clubs
                            foreach($clubs as $key_club => $club){
                                foreach($club->teams as $key_team => $team){
                                    // scor stafeta
                                    foreach($ranking_general as $general_team_category){
                                        if($team->name == $general_team_category['name']){
                                            $list_clubs[$club->name][$category->name][] = $general_team_category['scor_stafeta'];
                                        }
                                    }
                                }

                            }
            }


        // check if bonus is present Articolul 12 - 12.2 - c.
        foreach($clubs as $club){
            $list_clubs[$club->name]['bonus'] = 0;
            foreach($club->teams as $team){

            $knowledge_bonus = Knowledge::where('team_id', $team->id)->whereIn('abandon', [0,2])->count();
            $orienteering_bonus = Orienteering::where('team_id', $team->id)->whereIn('abandon', [0,2])->count();
            $raidmontanparticipations_bonus = RaidmontanParticipations::where('team_id', $team->id)->whereIn('abandon', [0,2])->count();

                if($knowledge_bonus == 1 && $orienteering_bonus == 1 && $raidmontanparticipations_bonus == 1){
                    $list_clubs[$club->name]['bonus'] += 10;
                }
            }
        }

  

        $rankings = [];
        foreach($list_clubs as $club_key => $club){
            $rankings[$club_key]['bonus'] = $club['bonus'];
            // start with bonus total_sm
            $rankings[$club_key]['total_sm'] = $club['bonus'];
            $rankings[$club_key]['club_name'] = $club_key;
            foreach($categories as $category){
                if(isset($list_clubs[$club_key][$category->name])){
                    $collection = collect($club[$category->name]);
                    $collection = $collection->sortDesc();
                    $collection = $collection->toArray();
                    $collection = array_values($collection);
                    $rankings[$club_key][$category->name] = $collection[0];
                    // $rankings[$club_key]['total_sm'] += $collection[0];
                    $rankings[$club_key]['categories'][$category->name] = $collection[0];

                } else {
                    $rankings[$club_key][$category->name] = 0;
                    // $rankings[$club_key]['total_sm'] += 0;
                    $rankings[$club_key]['categories'][$category->name] = 0;
                }

            }

            $coll = collect($rankings[$club_key]['categories']);
            $coll = $coll->sortDesc();
            $rankings[$club_key]['categories'] = $coll->toArray();

            $count = 1;
            foreach($rankings[$club_key]['categories'] as $category){
                if($count <= 4){

                    $rankings[$club_key]['total_sm'] += $category;
                    $count++;
                }
            }

            
        }


        // reset array key in order to do rank
        // dd($rankings);
        $rankings = array_values($rankings);


        // order by total_sm desc
        $rankings = collect($rankings);
        $rankings = $rankings->sortBy([
            ['total_sm', 'desc'],
        ]);

        // convert to array + reindex array key to be from 0 to ...
        $rankings  = array_values($rankings->toArray());

        // rank
        $x = 1;
        $unique_id = 0;

    
        
        foreach($rankings as $key => $team){
            $decrease_rank = 0;
            $rankings[$key]['rank'] = $x;
                if(isset($rankings[$key-1]))
                {
                    if($team['total_sm'] == $rankings[$key-1]['total_sm'] && $team['total_sm'] == $rankings[$key-1]['total_sm'])
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

        // dd($rankings);
        // return view('rankings.general',compact('rankings','categories'));

        $pdf = PDF::loadView('rankings.general_pdf', ['rankings' => $rankings, 'categories' => $categories]);
        $pdf->setPaper('A4', 'landscape');
        $general_pdf = 'rankings.general_pdf';
        return $pdf->stream($general_pdf);

    }


}
