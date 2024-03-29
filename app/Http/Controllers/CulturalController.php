<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Cultural;
use PDF;
use App\Models\Stages;

class CulturalController extends Controller
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
        $clubs = Club::get();

        $cultural = [];
        foreach($clubs as $key => $club){
            $cultural[$key]['name'] = $club->name;
            $cultural[$key]['id'] = $club->id;
            $club_with_cultural = Cultural::where('stage_id', $stageid)->where('club_id', $club->id)->first();
            if(!empty($club_with_cultural)){
                $cultural[$key]['scor'] = $club_with_cultural->scor;
            } else {
                $cultural[$key]['scor'] = 0;
            }
        }

        // sort desc by score
        usort($cultural, function ($item1, $item2) {
            return $item2['scor'] <=> $item1['scor'];
        });

        $rankings = array();
        $x = 1;
        $unique_id = 0;

        // create rank for teams
        foreach($cultural as $key => $participant){
            $decrease_rank = 0;
            $rankings[$unique_id]['id'] = $participant['id'];
            $rankings[$unique_id]['name'] = $participant['name'];
            $rankings[$unique_id]['scor'] = $participant['scor'];
            $rankings[$unique_id]['rank'] = $x;
            if(isset($cultural[$key-1]))
            {
                if($participant['scor'] == $cultural[$key-1]['scor'])
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

        return view('cultural.index',compact('rankings', 'stageid'));
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
                $notification = array(
                    'success_title' => 'Eroare!!',
                    'message' => 'Eroare la validarea datelor',
                    'alert-type' => 'error'
                );
                return redirect()->route('cultural.index', [$stageid])->with($notification);
            } else {
                $cultural = Cultural::where('stage_id', $stageid)->where('club_id', $id)->first();
                // if the team is not already in cultural table, populate the blade with some temporary records.
                if($cultural == null) {
                    $scor = '';
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('cultural.edit', ['club' => $club, 'scor' => $scor, 'stageid' => $stageid])->render()
                    ] );
                } else {
                    // if the team already have records in cultural table get the data and populate the blade
                    $scor = $cultural->scor;
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('cultural.edit', ['club' => $club, 'scor' => $scor, 'stageid' => $stageid])->render()
                    ] );
                }
            }

        }  else {
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Ilegal operation. The administrator was notified.',
                'alert-type' => 'error'
            );
            return redirect()->route('dashboard', [$stageid])->with($notification);
        }
    }


    public function update($stageid, $id, Request $request)

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
                    $notification = array(
                        'success_title' => 'Eroare!!',
                        'message' => 'Eroare la validarea datelor',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('cultural.index', [$stageid])->with($notification);
                } else {

                    $rules = [
                        'scor' => 'required|numeric|max:255|min:0',
                    ];

                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['created_at' => date('Y-m-d H:i:s')]);
                    $request->merge(['club_id' => $club->id]);
                    $request->merge(['stage_id' => $stageid]);
                    $data = $request->only(['stage_id', 'club_id', 'scor', 'created_at', 'updated_at']);
                    $validator = Validator::make($data, $rules);

                    if($validator->passes())
                    {
                    $cultural = Cultural::where('stage_id', $stageid)->where('club_id', $id)->first();
                        if($cultural == null) {
                            // if team doesn't have the data in db, insert it.
                            Cultural::create($data);
                            $ajax_redirect_url = route('cultural.index', [$stageid]);
                            $ajax_message_response = "Punctele au fost adaugate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'stageid' => $stageid], 200);
                        } else {
                            // if team have the data in db, update it without created_at.
                            unset($data['created_at']);
                            Cultural::findOrFail($cultural->id)->update($data);
                            $ajax_redirect_url = route('cultural.index', [$stageid]);
                            $ajax_message_response = "Punctele au fost actualizate.";
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
            return redirect()->route('dashboard', [$stageid])->with($notification);
        }
    }

    public function cultural_rank_pdf($stageid)
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

        $clubs = Club::get();

        if(!empty($clubs)){

            $cultural = [];
            foreach($clubs as $key => $club){
                $cultural[$key]['name'] = $club->name;
                $cultural[$key]['id'] = $club->id;
                $club_with_cultural = Cultural::where('stage_id', $stageid)->where('club_id', $club->id)->first();
                if(!empty($club_with_cultural)){
                    $cultural[$key]['scor'] = $club_with_cultural->scor;
                } else {
                    $cultural[$key]['scor'] = 0;
                }
            }

        // sort cultural array by score desc
        usort($cultural, function ($item1, $item2) {
            return $item2['scor'] <=> $item1['scor'];
        });

        $rankings = array();
        $x = 1;
        $unique_id = 0;
    
        // create rank based on cultural -> score
            foreach($cultural as $key => $participant){
                $decrease_rank = 0;
                $rankings[$unique_id]['id'] = $participant['id'];
                $rankings[$unique_id]['name'] = $participant['name'];
                $rankings[$unique_id]['scor'] = $participant['scor'];
                $rankings[$unique_id]['rank'] = $x;
                if(isset($cultural[$key-1]))
                {
                    if($participant['scor'] == $cultural[$key-1]['scor'])
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


            $pdf = PDF::loadView('cultural.rank_pdf', ['rankings' => $rankings, 'stageid' => $stageid]);

            $pdf->setPaper('A4', 'landscape');
            $listrankcultural = 'cultural_rank.pdf';
            return $pdf->stream($listrankcultural);
        } else {
            $notification = array(
                'message' => 'Nu puteți exporta în pdf.',
                'alert-type' => 'warning'
            );

            return redirect()->route('cultural.index', [$stageid])->with($notification);
        }

    }

}
