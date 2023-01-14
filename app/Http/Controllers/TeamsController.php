<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Team;
use App\Models\Category;
use App\Models\UuidOrienteeting;
use App\Models\UuidRaid;
use App\Models\TeamOrderStart;
use PDF;
use DB;

class TeamsController extends Controller
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
        $teams = Team::with('category')->with('club')->with('uuid_orienteering')->with('uuid_raid')->OrderBy('id', 'ASC')->get();
        $clubs_count = Club::get()->count();
        if($clubs_count == 0){
            $notification = array(
                'success_title' => 'Eroare!!',
                'message' => 'Nu aveti nici un club in baza de date.',
                'alert-type' => 'error'
            );
            return redirect()->route('clubs.index')->with($notification);
        } else {
            return view('teams.index',compact('teams'));
        }
    }

    public function create(Request $request)
    {
        if( $request->ajax() )
        {

            $clubs = Club::OrderBy('name', 'ASC')->get();
            $categories = Category::OrderBy('id', 'ASC')->get();

            $used_uuid_orienteering = [];
            $used_uuid_raid = [];
            $teams = Team::get();
            foreach($teams as $key => $team){
                $used_uuid_orienteering[] = $team->uuid_card_orienteering_id;
                $used_uuid_raid[] = $team->uuid_card_raid_id;
            }

            $uuid_orienteering = UuidOrienteeting::OrderBy('id', 'ASC')->whereNotIn('id', $used_uuid_orienteering)->get();
            $uuid_raid = UuidRaid::OrderBy('id', 'ASC')->whereNotIn('id', $used_uuid_raid)->get();
            $ajax_status_response = "success";
            return response()->json( [
                'ajax_status_response' => $ajax_status_response,
                'view_content' => view('teams.create', ['clubs' => $clubs, 'categories' => $categories, 'uuid_orienteering' => $uuid_orienteering, 'uuid_raid' => $uuid_raid])->render()
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

    public function store(Request $request)
    {
        if( $request->ajax() )
        {

            $rules = [
                'name' => 'required|max:255|min:3',
                'club_id' => 'required|numeric|exists:clubs,id',
                'category_id' => 'required|numeric|exists:categories,id',
                'number' => 'required|numeric|max:50000|min:1|unique:teams,number',
                'uuid_card_orienteering_id' => 'required|numeric|exists:uuids_orienteering,id',
                'uuid_card_raid_id' => 'required|numeric|exists:uuids_raid,id',
            ];

            $request->merge(['created_at' => date('Y-m-d H:i:s')]);
            $request->merge(['updated_at' => date('Y-m-d H:i:s')]);


            // clean input before update in db
            $data = $request->only(['name', 'club_id', 'category_id', 'number', 'uuid_card_orienteering_id', 'uuid_card_raid_id', 'created_at', 'updated_at']);
            $validator = Validator::make($data, $rules);

                $find_team= Team::where('name', $data['name'])->where('category_id', $data['category_id'])->first();
                if($find_team !== null){
                    $validator->after(function ($validator) {
                        $validator->errors()->add('name', 'Numele echipei exista deja in baza de date!');
                    });
                }

            if($validator->passes())
            {

                Team::create($data);

                $ajax_redirect_url = route('teams.index');
                $ajax_message_response = "Echipa a fost adaugata.";
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


    public function edit($id, Request $request)
    {
        if( $request->ajax() )
        {
            $team = Team::FindOrFail($id);

            if($team == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json(['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
            } else {

                $clubs = Club::OrderBy('name', 'ASC')->get();
                $categories = Category::OrderBy('id', 'ASC')->get();
                $used_uuid_orienteering = [];
                $used_uuid_raid = [];
                $teams = Team::get();
                foreach($teams as $key => $team_result){
                    if($team->id == $team_result->id){
                        continue;
                    } else {
                        $used_uuid_orienteering[] = $team_result->uuid_card_orienteering_id;
                        $used_uuid_raid[] = $team_result->uuid_card_raid_id; 
                    }
                }
    
                $uuid_orienteering = UuidOrienteeting::OrderBy('id', 'ASC')->whereNotIn('id', $used_uuid_orienteering)->get();
                $uuid_raid = UuidRaid::OrderBy('id', 'ASC')->whereNotIn('id', $used_uuid_raid)->get();

                $ajax_status_response = "success";
                return response()->json( [
                    'ajax_status_response' => $ajax_status_response,
                    'view_content' => view('teams.edit', ['team' => $team, 'clubs' => $clubs, 'categories' => $categories, 'uuid_orienteering' => $uuid_orienteering, 'uuid_raid' => $uuid_raid])->render()
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


    public function update($id, Request $request)

    {
        if( $request->ajax() )
        {
            $team = Team::FindOrFail($id);

                if($team == null) {
                    $ajax_message_response = "Eroare la validarea datelor!";
                    $ajax_title_response = "Eroare!";
                    $ajax_status_response = "error";
                    return response()->json(['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
                } else {

                    $rules = [
                        'name' => 'required|max:255|min:3',
                        'club_id' => 'required|numeric|exists:clubs,id',
                        'category_id' => 'required|numeric|exists:categories,id',
                        'number' => 'required|numeric|max:50000|min:1',
                        'uuid_card_orienteering_id' => 'required|numeric|exists:uuids_orienteering,id',
                        'uuid_card_raid_id' => 'required|numeric|exists:uuids_raid,id',
                    ];

                    $request->merge(['updated_at' => date('Y-m-d H:i:s')]);

                    $data = $request->only(['name', 'club_id', 'category_id', 'number', 'uuid_card_orienteering_id', 'uuid_card_raid_id', 'updated_at']);

                    // clean input before update in db
                    $data['name'] =  trim(strip_tags($request->input('name'), ''));

                    $validator = Validator::make($data, $rules);

                    if($data['number'] != $team->number){
                        $find_team_number = Team::where('number', $data['number'])->first();
                        if($find_team_number !== null){
                            $validator->after(function ($validator) {
                                $validator->errors()->add('number', 'Numarul de participare exista in baza de date!');
                            });
                        }
                    }

                    if($data['name'] != $team->name){
                        $find_team= Team::where('name', $data['name'])->where('category_id', $data['category_id'])->first();
                        if($find_team !== null){
                            $validator->after(function ($validator) {
                                $validator->errors()->add('name', 'Numele echipei exista deja in baza de date!');
                            });
                        }
                    }

                    if($validator->passes())
                    {
                            Team::findOrFail($id)->update($data);
                            $ajax_redirect_url = route('teams.index');
                            $ajax_message_response = "Datele au fost salvate.";
                            $ajax_title_response = "Felicitări!";
                            $ajax_status_response = "success";
                            return response()->json(['ajax_redirect_url' => $ajax_redirect_url,'ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response], 200);
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

    public function destroy($id, Request $request)
    {
        if( $request->ajax() )
        {
            $team = Team::FindOrFail($id);

            if ($team == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );
            } else {
                    $ajax_status_response = "success";
                    return response()->json( [
                        'ajax_status_response' => $ajax_status_response,
                        'view_content' => view('teams.destroy', compact('team'))->render()
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

    public function destroy_confirm($id, Request $request)
    {
        if( $request->ajax() )
        {
            $team = Team::FindOrFail($id);

            if ($team == null) {
                $ajax_message_response = "Eroare la validarea datelor!";
                $ajax_title_response = "Eroare!";
                $ajax_status_response = "error";
                return response()->json( ['ajax_status_response' => $ajax_status_response, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response] );
            } else {

                    $team->delete();
                    $ajax_redirect_url = route('teams.index');
                    $ajax_message_response = "Echipa a fost stersa!";
                    $ajax_title_response = "Felicitări!";
                    $ajax_status_response = "success";
                    return response()->json(['ajax_redirect_url' => $ajax_redirect_url, 'ajax_title_response' => $ajax_title_response, 'ajax_message_response' => $ajax_message_response, 'ajax_status_response' => $ajax_status_response]);
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

    public function teams_listbyteams_pdf()
    {
        $teams = Team::with('club')->with('uuid_orienteering')->with('uuid_raid')->with('category')->get();

        if($teams->isEmpty() === false) {

            $categories = Category::get();
            $number = 1;
            $teams_list = [];
            foreach($teams as $key => $team){
                $teams_list[$key]['number'] = $team->number;
                $teams_list[$key]['uuid_orienteering_id'] = $team->uuid_orienteering->id;
                $teams_list[$key]['uuid_orienteering_name'] = $team->uuid_orienteering->name;
                $teams_list[$key]['uuid_raid_id'] = $team->uuid_orienteering->id;
                $teams_list[$key]['uuid_raid_name'] = $team->uuid_raid->name;
                $teams_list[$key]['name'] = $team->name;
                $teams_list[$key]['club'] = $team->club->name;
                $teams_list[$key]['category'] = $team->category->name;
            }

            usort($teams_list, function ($item1, $item2) {
                return $item2['category'] <=> $item1['category'];
            });

            $pdf = PDF::loadView('teams.listbyteams_pdf', ['teams_list' => $teams_list, 'number' => $number]);

            $pdf->setPaper('A4', 'landscape');
            $listbyteams = 'listbyteams.pdf';
            return $pdf->stream($listbyteams);
        } else {
            $notification = array(
                'message' => 'Nu puteți exporta în pdf.',
                'alert-type' => 'warning'
            );

            return redirect()->route('teams.index')->with($notification);
        }

    }



    //

    public $total_no = 0;
    public $ultimul_club = '';
    public $final_list_teams = [];
    public $team_list_global = [];

    public function club_prea_mare()
    {
      $max = 0;
      $club_id = 0;
      $total_no_of_teams = 0;

      foreach ($this->team_list_global as $key => $values) {

        $current_max = count($values);
        if($current_max > $max)
        {
          $max = $current_max;
          $club_id = $key;
        }
        $total_no_of_teams += $current_max;
      }

      if($max > ($total_no_of_teams - $max))
      {
        return $club_id;
      }
      else {
        return false;
      }
    }

    public function alegere_echipa($club_id)
    {
      $echipa_aleasa = array_rand($this->team_list_global[$club_id]);

      $this->final_list_teams [] = [
        'order' => $this->team_list_global[$club_id][$echipa_aleasa][4],
        'category' => $this->team_list_global[$club_id][$echipa_aleasa][3],
        'club' => $this->team_list_global[$club_id][$echipa_aleasa][2],
        'team' => $this->team_list_global[$club_id][$echipa_aleasa][1],
        'club_id' => $club_id
      ];

      unset($this->team_list_global[$club_id][$echipa_aleasa]);

      if(empty($this->team_list_global[$club_id]))
      {
        unset($this->team_list_global[$club_id]);
      }

      $this->ultimul_club = $club_id;
    }

    public function index_team_order_start() {

        $categories = Category::orderBy('order_start', 'ASC')->get();

        foreach ($categories as $key => $category)
        {
 
            $clubs_list = Club::with('teams')->get();

            $clubs = [];
            foreach($clubs_list as $key => $club){
                foreach($club->teams as $team){
                    if($team->category_id == $category->id){
                        $clubs[$key]['club_name'] = $club->name;
                        $clubs[$key]['club_id'] = $club->id;
                    }
                }
            }

          $team_list = [];

          foreach ($clubs as $key => $value)
          {
            $teams = DB::table('teams')->where('club_id', $value['club_id'])->where('category_id', $category->id)->get();
            
            foreach ($teams as $key2 => $value2)
            {

              $team_list[$value['club_id']] [] = [$value2->id, $value2->name, $value['club_name'], $category->name, $category->id];
            }
          }

          $this->team_list_global = $team_list;

          while($this->team_list_global != null)
          {
            $club_mare = $this->club_prea_mare();

            if($club_mare)
            {
              $this->alegere_echipa($club_mare);
            }

            $club_array = [];

            foreach ($this->team_list_global as $key => $value) {
              if($key != $club_mare)
              {
                $club_array [] = $key;
              }
            }

            if(!empty($club_array))
            {
              $club_ales_key = array_rand($club_array);

              $club_ales = $club_array[$club_ales_key];

              $count_all_current_teams = count($this->final_list_teams) - 1;

              if($count_all_current_teams >= 0 && count($club_array) > 2)
              {

                if($club_ales == $this->final_list_teams[$count_all_current_teams]['club_id'])
                {
                  while($club_ales == $this->final_list_teams[$count_all_current_teams]['club_id'])
                  {
                      $club_ales_key = array_rand($club_array);

                      $club_ales = $club_array[$club_ales_key];
                  }
                }

                $this->alegere_echipa($club_ales);
              }
              else {
                $this->alegere_echipa($club_ales);
              }
            }
          }
        }


        $results = $this->final_list_teams;

        $clubs = Club::with('teams')->get();

        $number = 1;
        $order_start = TeamOrderStart::where('id', 1)->first();
        $data_start = \Carbon\Carbon::parse($order_start->order_date_start);
        $minute_start = $order_start->order_start_minutes;


        $categories_data = Category::get();
        $category_result = [];

        foreach ( $categories_data as $value )
        {
            $category_result[ $value['category_id'] ] = $value['category_name'];
        }

        foreach ($clubs as $key => $club){

            foreach ($club->teams as $teams){

                if($club->club_id == $teams->club_id)
                {
                    $category_data = Category::where('category_id',$teams->category_id)->first();
                    $array_category[$category_data['order_start']][$teams->category_id][$club->club_name][] = $teams->team_name;
                }
            }
        }

        function sortTeams($last_club, $array_start, $array_final)
        {

            arsort($array_start);

            foreach ( $array_start as $club => $teams )
            {

                if( count($array_start[$club]) == 0 ) // if the club doesn't have teams, mark as out
                {
                    unset($array_start[$club]);
                    return [ $array_final, $array_start, $last_club ];
                }

                if( count($array_start) == 1 ) //if there is only one club left, we add all its teams at the end
                {
                    $total_teams = count($array_start[$club]);
                    $array_final[] = [ $club => $array_start[$club][$total_teams-1] ];

                    unset($array_start[$club][$total_teams-1]);

                    $last_club = $club;
                    return [ $array_final, $array_start, $last_club ];
                }

                if( $last_club != $club ) //if the club is different from the previous one, we add the team
                {
                    $total_teams = count($array_start[$club]);
                    $array_final[] = [ $club => $array_start[$club][$total_teams-1] ];

                    unset($array_start[$club][$total_teams-1]);

                    $last_club = $club;

                    return [ $array_final, $array_start, $last_club ];
                }

            }
        }


        $array_final = [];
        $last_club = '';
        $array_with_categories = [];

        $number = 1;

        return view('teams.order_start', ['results' => $results, 'number' => $number, 'data_start' => $data_start, 'minute_start' => $minute_start]);

    }


    public function index_team_order_start_pdf() {

                $categories = Category::orderBy('order_start', 'ASC')->get();
        
                foreach ($categories as $key => $category)
                {
                    

                    $clubs_list = Club::with('teams')->get();
        
                    $clubs = [];
                    foreach($clubs_list as $key => $club){
                        foreach($club->teams as $team){
                            if($team->category_id == $category->id){
                                $clubs[$key]['club_name'] = $club->name;
                                $clubs[$key]['club_id'] = $club->id;
                            }
                        }
                    }
        
                  $team_list = [];
        
                  foreach ($clubs as $key => $value)
                  {
                    $teams = DB::table('teams')->where('club_id', $value['club_id'])->where('category_id', $category->id)->get();
                    

                    foreach ($teams as $key2 => $value2)
                    {
        
                      $team_list[$value['club_id']] [] = [$value2->id, $value2->name, $value['club_name'], $category->name, $category->id];
                    }
                  }
        
                  $this->team_list_global = $team_list;
        
                  while($this->team_list_global != null)
                  {
                    $club_mare = $this->club_prea_mare();
        
                    if($club_mare)
                    {
                      $this->alegere_echipa($club_mare);
                    }
        
                    $club_array = [];
        
                    foreach ($this->team_list_global as $key => $value) {
                      if($key != $club_mare)
                      {
                        $club_array [] = $key;
                      }
                    }
        
                    if(!empty($club_array))
                    {
                      $club_ales_key = array_rand($club_array);
        
                      $club_ales = $club_array[$club_ales_key];
        
                      $count_all_current_teams = count($this->final_list_teams) - 1;
        
                      if($count_all_current_teams >= 0 && count($club_array) > 2)
                      {
        
                        if($club_ales == $this->final_list_teams[$count_all_current_teams]['club_id'])
                        {
                          while($club_ales == $this->final_list_teams[$count_all_current_teams]['club_id'])
                          {

        
                              $club_ales_key = array_rand($club_array);
        
                              $club_ales = $club_array[$club_ales_key];
                          }
                        }
        
                        $this->alegere_echipa($club_ales);
                      }
                      else {
                        $this->alegere_echipa($club_ales);
                      }
                    }
                  }
                }

                $results = $this->final_list_teams;
        
                $clubs = Club::with('teams')->get();
        
                $number = 1;
                $order_start = TeamOrderStart::where('id', 1)->first();
                $data_start = \Carbon\Carbon::parse($order_start->order_date_start);
                $minute_start = $order_start->minutes;
        
        
                $categories_data = Category::get();
                $category_result = [];
        
                foreach ( $categories_data as $value )
                {
                    $category_result[ $value['category_id'] ] = $value['category_name'];
                }
        
                foreach ($clubs as $key => $club){
        
                    foreach ($club->teams as $teams){
        
                        if($club->club_id == $teams->club_id)
                        {
                            $category_data = Category::where('category_id',$teams->category_id)->first();
                            $array_category[$category_data['order_start']][$teams->category_id][$club->club_name][] = $teams->team_name;
                        }
                    }
                }
        
                function sortTeams($last_club, $array_start, $array_final)
                {
        
                    arsort($array_start);
        
                    foreach ( $array_start as $club => $teams )
                    {
        
                        if( count($array_start[$club]) == 0 ) 
                        {
                            unset($array_start[$club]);
                            return [ $array_final, $array_start, $last_club ];
                        }
        
                        if( count($array_start) == 1 ) 
                        {
                            $total_teams = count($array_start[$club]);
                            $array_final[] = [ $club => $array_start[$club][$total_teams-1] ];
        
                            unset($array_start[$club][$total_teams-1]);
        
                            $last_club = $club;
                            return [ $array_final, $array_start, $last_club ];
                        }
        
                        if( $last_club != $club ) 
                        {
                            $total_teams = count($array_start[$club]);
                            $array_final[] = [ $club => $array_start[$club][$total_teams-1] ];
        
                            unset($array_start[$club][$total_teams-1]);
        
                            $last_club = $club;
        
                            return [ $array_final, $array_start, $last_club ];
                        }
        
                    }
                }
        
        
                $array_final = [];
                $last_club = '';
                $array_with_categories = [];
    
                $number = 1;
    
                $pdf = PDF::loadView('teams.order_start_pdf', ['results' => $results, 'number' => $number, 'data_start' => $data_start, 'minute_start' => $minute_start]);
                $pdf->setPaper('A4', 'landscape');
                $team_order_pdf = 'teams_order_start_pdf';
                return $pdf->stream($team_order_pdf);
                
        
            }


}
