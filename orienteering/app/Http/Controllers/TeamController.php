<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Club;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;
use Excel;
use PDF;
use Input;
use Carbon\Carbon;
use App\Models\Organizer;
use App\Models\OrderStart;

class TeamController extends Controller
{

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

    public function index() {


//        $categories = DB::select('SELECT category_id, category_name from categories order by category_id asc');
        $categories = DB::select('SELECT category_id, category_name from categories order by order_start asc');

        foreach ($categories as $key => $category)
        {
          // $clubs = DB::table('clubs')->leftJoin('teams', 'clubs.club_id', '=', 'teams.club_id')->where('teams.category_id', $category->category_id)->groupBy('clubs.club_name')->get();
          $clubs = DB::select('SELECT DISTINCT a.club_name, a.club_id from clubs as a left join teams as b on a.club_id = b.club_id where b.category_id = ' . $category->category_id . '');

          // var_dump($category->category_name);

          $team_list = [];

          foreach ($clubs as $key => $value)
          {
            $teams = DB::table('teams')->where('club_id', $value->club_id)->where('category_id', $category->category_id)->get();

            // var_dump($value->club_name);
            // var_dump(count($teams));

            // $teams = DB::select('SELECT DISTINCT team_name, team_id from teams WHERE club_id = ' . $value->club_id  . ' GROUP BY team_name, team_id');

            foreach ($teams as $key2 => $value2)
            {

              $team_list[$value->club_id] [] = [$value2->team_id, $value2->team_name, $value->club_name, $category->category_name, $category->category_id];
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
                // do {
                //   $club_ales_key = array_rand($club_array);
                //
                //   $club_ales = $club_array[$club_ales_key];
                //
                // } while ($club_ales != $this->final_list_teams[$count_all_current_teams]['club_id']);

                if($club_ales == $this->final_list_teams[$count_all_current_teams]['club_id'])
                {
                  while($club_ales == $this->final_list_teams[$count_all_current_teams]['club_id'])
                  {
                    // var_dump($club_ales);
                    // var_dump($this->final_list_teams[$count_all_current_teams]['club_id']);
                    //
                    // var_dump('=');

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

// dd($this->final_list_teams);

        $results = $this->final_list_teams;

        // $teams_db = DB::table('teams')
        //       ->select('teams.team_name', 'categories.category_name', 'clubs.club_name', 'categories.category_id')
        //       ->leftJoin('categories', 'categories.category_id', '=', 'teams.category_id')
        //       ->leftJoin('clubs', 'clubs.club_id', '=', 'teams.club_id')
        //       ->whereIn('teams.team_id', $this->final_list_teams)
        //       ->get();
        //
        // $order = 1;
        //
        // // dd(count($teams_db));
        //
        // foreach ($teams_db as $key_team => $value)
        // {
        //   if($key_team != 0 && $teams_db[$key_team]->category_name != $teams_db[$key_team - 1]->category_name)
        //   {
        //     $order++;
        //   }
        //
        //   $results[] = array('order' => $order, 'category' => $value->category_name, 'club' => $value->club_name, 'team' => $value->team_name);
        // }

        // var_dump($results);
        // die();


        // ===== pana aici;

        $clubs = Club::with('teams')->get();

        $number = 1;
        $order_start = OrderStart::where('id', 1)->first();
        $data_start = \Carbon\Carbon::parse($order_start->date_start);
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

                if( count($array_start[$club]) == 0 ) //daca clubul nu mai are echipe il scoatem
                {
                    unset($array_start[$club]);
                    return [ $array_final, $array_start, $last_club ];
                }

                if( count($array_start) == 1 ) //daca mai exista doar un club, adaugam toate echipele lui la final
                {
                    $total_teams = count($array_start[$club]);
                    $array_final[] = [ $club => $array_start[$club][$total_teams-1] ];

                    unset($array_start[$club][$total_teams-1]);

                    $last_club = $club;
                    return [ $array_final, $array_start, $last_club ];
                }

                if( $last_club != $club ) //daca clubul e diferit de cel de dinainte adaugam echipa
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

//        echo "<pre>";
        //
        // foreach ( $array_category as $order => $categories )
        // {
        //
        //     foreach ( $categories as $category => $array_teams )
        //     {
        //         $array_start = $array_teams;
        //         $array_final = [];
        //
        //         while( !empty($array_start) )
        //         {
        //
        //             list($array_final, $array_start, $last_club) = sortTeams($last_club, $array_start, $array_final);
        //
        //         }
        //
        //         $array_with_categories[$order][$category] = $array_final;
        //     }
        //
        // }




//        echo "</br>";
//        echo "</br>";
//        echo "Rezultatul Final";
//
//        echo "</br>";
//        echo "</br>";

//         ksort( $array_with_categories );
//
//         foreach ( $array_with_categories as $order => $categories )
//         {
//
//             foreach ( $categories as $category => $teams )
//             {
//                 foreach ($teams as $team)
//                 {
//
//                     foreach ( $team as $club => $team_name )
//                     {
//
//                         // $results[] = array('order' => $order, 'category' => $category_result[$category], 'club' => $club, 'team' => $team_name);
// //                        echo  'Ordine: '.$order.' <b>Categoria</b>: '. $category_result[$category] .' <b>Clubul</b>: '.$club.' <b>Echipa</b>: '.$team_name.'</br>';
//                     }
//
//                 }
//             }
//
//         }

//         dd($results);
        $number = 1;

        return view('orienteering.order_start', ['results' => $results, 'number' => $number, 'data_start' =>$data_start, 'minute_start' => $minute_start]);


    }

    public function pdf() {

        $organizer = Organizer::where('id_organizer', '1')->first();
        $categories = DB::select('SELECT category_id, category_name from categories order by order_start asc');

        foreach ($categories as $key => $category)
        {
            // $clubs = DB::table('clubs')->leftJoin('teams', 'clubs.club_id', '=', 'teams.club_id')->where('teams.category_id', $category->category_id)->groupBy('clubs.club_name')->get();
            $clubs = DB::select('SELECT DISTINCT a.club_name, a.club_id from clubs as a left join teams as b on a.club_id = b.club_id where b.category_id = ' . $category->category_id . '');

            // var_dump($category->category_name);

            $team_list = [];

            foreach ($clubs as $key => $value)
            {
                $teams = DB::table('teams')->where('club_id', $value->club_id)->where('category_id', $category->category_id)->get();

                // var_dump($value->club_name);
                // var_dump(count($teams));

                // $teams = DB::select('SELECT DISTINCT team_name, team_id from teams WHERE club_id = ' . $value->club_id  . ' GROUP BY team_name, team_id');

                foreach ($teams as $key2 => $value2)
                {

                    $team_list[$value->club_id] [] = [$value2->team_id, $value2->team_name, $value->club_name, $category->category_name, $category->category_id];
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
                        // do {
                        //   $club_ales_key = array_rand($club_array);
                        //
                        //   $club_ales = $club_array[$club_ales_key];
                        //
                        // } while ($club_ales != $this->final_list_teams[$count_all_current_teams]['club_id']);

                        if($club_ales == $this->final_list_teams[$count_all_current_teams]['club_id'])
                        {
                            while($club_ales == $this->final_list_teams[$count_all_current_teams]['club_id'])
                            {
                                // var_dump($club_ales);
                                // var_dump($this->final_list_teams[$count_all_current_teams]['club_id']);
                                //
                                // var_dump('=');

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
        $order_start = OrderStart::where('id', 1)->first();
        $data_start = \Carbon\Carbon::parse($order_start->date_start);
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

                if( count($array_start[$club]) == 0 ) //daca clubul nu mai are echipe il scoatem
                {
                    unset($array_start[$club]);
                    return [ $array_final, $array_start, $last_club ];
                }

                if( count($array_start) == 1 ) //daca mai exista doar un club, adaugam toate echipele lui la final
                {
                    $total_teams = count($array_start[$club]);
                    $array_final[] = [ $club => $array_start[$club][$total_teams-1] ];

                    unset($array_start[$club][$total_teams-1]);

                    $last_club = $club;
                    return [ $array_final, $array_start, $last_club ];
                }

                if( $last_club != $club ) //daca clubul e diferit de cel de dinainte adaugam echipa
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


        $pdf = PDF::loadView('orienteering.order_start_pdf', ['results' => $results, 'number' => $number, 'data_start' =>$data_start, 'minute_start' => $minute_start, 'organizer' => $organizer]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('ordine_start.pdf');

    }

    public  function order_start() {

        $categories = Category::get();
        $order_start = OrderStart::where('id', 1)->first();
        $minutes = 60;

        return view('order_start.edit', ['categories' => $categories, 'order_start' => $order_start, 'minutes' => $minutes]);

    }

    public  function order_start_post() {

        $category[1] = $_POST['category_1'];
        $category[2] = $_POST['category_2'];
        $category[3] = $_POST['category_3'];
        $category[4] = $_POST['category_4'];
        $category[5] = $_POST['category_5'];
        $category[6] = $_POST['category_6'];
        $category[7] = $_POST['category_7'];
        $date_start = $_POST['date_start'];
        $minutes = $_POST['minutes'];

        foreach ($category as $key => $cat){
//            echo $key . " xx ". $cat . "<br />";
            Category::where('category_id', $key)->update(array(
                'order_start' 	  =>  $cat,
            ));
        }

        OrderStart::where('id', 1)->update(array(
            'date_start' 	  =>  $date_start,
            'minutes' =>  $minutes,
        ));

        return redirect('/order-start/edit')->with('success', 'Datele au fost salvate');

    }

}
