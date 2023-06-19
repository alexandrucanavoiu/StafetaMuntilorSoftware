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
use App\Models\UuidRaid;
use App\Models\UuidOrienteeting;
use DB;
use Illuminate\Validation\Rule;
use Excel;
use PDF;

class ImportController extends Controller
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
        $teams = Team::All()->count();
        $participations_raidmontan = RaidmontanParticipations::All()->count();
        $participations_orienteering = Orienteering::All()->count();

        return view('import.index',compact('teams', 'participations_raidmontan', 'participations_orienteering'));
    }


    public function raidmontan_seed()
    {
        $teams = Team::with('category')->get();

        $create_date = date('Y-m-d H:i:s');
        $pa_stations_count = 0;
        $pfa_stations_count = 0;

        foreach($teams as $team){

            $raidmontan_stations_final = [];
            $raidmontan_stations_stages_id = [];

            $check = RaidmontanParticipations::get()->first();

            if($team->raidmontan_participations !== null){
                continue;

            } else {

                RaidmontanParticipationsEntries::where('team_id', $team->id)->delete();
                // If the team is not in RaidmontanParticipations table insert the data
                RaidmontanParticipations::insert([
                    'team_id' => $team->id,
                    'missing_equipment_items' => 0,
                    'missing_footwear' => 0,
                    'minimum_distance_penalty' => 0,
                    'abandon' => 1,
                    'created_at' => $create_date,
                    'updated_at' => $create_date
                ]);
    
    
                $RaidmontanParticipations = RaidmontanParticipations::where('team_id', $team->id)->first();
                $raidmontan_stations = RaidmontanStations::where('category_id', $team->category_id)->get();
                $raidmontan_stations_stages = RaidmontanStationsStages::where('category_id', $team->category_id)->get();

                $stage_start_id = 0;
                $stage_finish_id = 0;
                $stage_pa_id = [];
                $stage_pa_id_count = 1;
                $pa_stations_count = 0;
                foreach($raidmontan_stations_stages as $stage){
                    if($stage->post == 251){
                        $stage_start_id = $stage->id;
                    } elseif($stage->post == 252){
                        $stage_finish_id = $stage->id;
                    } else {
                        $stage_pa_id[$pa_stations_count] = $stage->id;
                        $pa_stations_count++;
                    }
    
                }
    
                $pa_stations_count = 0;

                foreach($raidmontan_stations as $key => $station){
            
                    $raidmontan_stations_final[$key]['raidmontan_participations_id'] = $RaidmontanParticipations->id;
                    $raidmontan_stations_final[$key]['team_id'] = $team->id;
                    $raidmontan_stations_final[$key]['raidmontan_stations_id'] = $station->id;
                    $raidmontan_stations_final[$key]['raidmontan_stations_station_type'] = $station->station_type;
                    
                    if($station->station_type == 0) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_start_id;
                        $raidmontan_stations_final[$key]['time_start'] = "00:00:00";
                        $raidmontan_stations_final[$key]['time_finish'] = NULL;
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                    }
    
                    if($station->station_type == 1) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_pa_id[$pa_stations_count];
                        $raidmontan_stations_final[$key]['time_start'] = "00:00:00";
                        $raidmontan_stations_final[$key]['time_finish'] = "00:00:00";
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                        $pa_stations_count++;
                    }
    
                    if($station->station_type == 2) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = NULL;
                        $raidmontan_stations_final[$key]['time_start'] = NULL;
                        $raidmontan_stations_final[$key]['time_finish'] = NULL;
                        $raidmontan_stations_final[$key]['hits'] = 1;
                        $pfa_stations_count++;
                    }
    
                    if($station->station_type == 3) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_finish_id;
                        $raidmontan_stations_final[$key]['time_start'] = NULL;
                        $raidmontan_stations_final[$key]['time_finish'] = "00:00:00";
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                    }
    
                    $raidmontan_stations_final[$key]['created_at'] = $create_date;
                    $raidmontan_stations_final[$key]['updated_at'] = $create_date;
                    
                }
            
                RaidmontanParticipationsEntries::insert($raidmontan_stations_final);

            }
        }

        $notification = array(
            'success_title' => 'Success',
            'message' => '(RaidMontan) Toate echipele au fost marcate ca Abandon, va rugam sa importati fisierul.',
            'alert-type' => 'success'
        );
        return redirect()->route('import.index')->with($notification);

    }


    public function raidmontan_seed_intern()
    {
        $teams = Team::with('category')->get();

        $create_date = date('Y-m-d H:i:s');
        $pa_stations_count = 0;
        $pfa_stations_count = 0;

        foreach($teams as $team){

            $raidmontan_stations_final = [];
            $raidmontan_stations_stages_id = [];

            $check = RaidmontanParticipations::get()->first();

            if($team->raidmontan_participations !== null){
                continue;

            } else {

                RaidmontanParticipationsEntries::where('team_id', $team->id)->delete();
                // If the team is not in RaidmontanParticipations table insert the data
                RaidmontanParticipations::insert([
                    'team_id' => $team->id,
                    'missing_equipment_items' => 0,
                    'missing_footwear' => 0,
                    'minimum_distance_penalty' => 0,
                    'abandon' => 1,
                    'created_at' => $create_date,
                    'updated_at' => $create_date
                ]);
    
    
                $RaidmontanParticipations = RaidmontanParticipations::where('team_id', $team->id)->first();
                $raidmontan_stations = RaidmontanStations::where('category_id', $team->category_id)->get();
                $raidmontan_stations_stages = RaidmontanStationsStages::where('category_id', $team->category_id)->get();

                $stage_start_id = 0;
                $stage_finish_id = 0;
                $stage_pa_id = [];
                $stage_pa_id_count = 1;
                $pa_stations_count = 0;
                foreach($raidmontan_stations_stages as $stage){
                    if($stage->post == 251){
                        $stage_start_id = $stage->id;
                    } elseif($stage->post == 252){
                        $stage_finish_id = $stage->id;
                    } else {
                        $stage_pa_id[$pa_stations_count] = $stage->id;
                        $pa_stations_count++;
                    }
    
                }
    
                $pa_stations_count = 0;

                foreach($raidmontan_stations as $key => $station){
            
                    $raidmontan_stations_final[$key]['raidmontan_participations_id'] = $RaidmontanParticipations->id;
                    $raidmontan_stations_final[$key]['team_id'] = $team->id;
                    $raidmontan_stations_final[$key]['raidmontan_stations_id'] = $station->id;
                    $raidmontan_stations_final[$key]['raidmontan_stations_station_type'] = $station->station_type;
                    
                    if($station->station_type == 0) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_start_id;
                        $raidmontan_stations_final[$key]['time_start'] = "00:00:00";
                        $raidmontan_stations_final[$key]['time_finish'] = NULL;
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                    }
    
                    if($station->station_type == 1) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_pa_id[$pa_stations_count];
                        $raidmontan_stations_final[$key]['time_start'] = "00:00:00";
                        $raidmontan_stations_final[$key]['time_finish'] = "00:00:00";
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                        $pa_stations_count++;
                    }
    
                    if($station->station_type == 2) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = NULL;
                        $raidmontan_stations_final[$key]['time_start'] = NULL;
                        $raidmontan_stations_final[$key]['time_finish'] = NULL;
                        $raidmontan_stations_final[$key]['hits'] = 1;
                        $pfa_stations_count++;
                    }
    
                    if($station->station_type == 3) {
                        $raidmontan_stations_final[$key]['raidmontan_stations_stages_id'] = $stage_finish_id;
                        $raidmontan_stations_final[$key]['time_start'] = NULL;
                        $raidmontan_stations_final[$key]['time_finish'] = "00:00:00";
                        $raidmontan_stations_final[$key]['hits'] = NULL;
                    }
    
                    $raidmontan_stations_final[$key]['created_at'] = $create_date;
                    $raidmontan_stations_final[$key]['updated_at'] = $create_date;
                    
                }
            
                RaidmontanParticipationsEntries::insert($raidmontan_stations_final);

            }
        }

    }


    public function orienteering_seed()
    {
        $teams = Team::with('category')->get();
        $create_date = date('Y-m-d H:i:s');

        foreach($teams as $team){

            $team_orienteering = Orienteering::where('team_id', $team->id)->first();

            if($team_orienteering == null){
                Orienteering::insert([
                    'team_id' => $team->id,
                    'start_time' => "00:00:00",
                    'finish_time' => "00:00:00",
                    'total_time' => "00:00:00",
                    'abandon' => 1,
                    'missed_posts' => NULL,
                    'order_posts' => NULL,
                    'created_at' => $create_date,
                    'updated_at' => $create_date
                ]);
            } else {
                continue;
            }

        }

        $notification = array(
            'success_title' => 'Success',
            'message' => '(Orientare) Toate echipele au fost marcate ca Abandon, va rugam sa importati fisierul.',
            'alert-type' => 'success'
        );
        return redirect()->route('import.index')->with($notification);

    }


    public function raidmontan_import_uuids(Request $request)
    {


        $this->validate($request, [

            'import_file' => 'required'

        ]);

        $teams = Team::all();

        $posts = [];
//        $posts[1]= [ 251,31,32,33,252 ]; //Family
//        $posts[2]= [ 251,31,33,33,252 ]; //Juniori
//        $posts[3]= [ 251,31,32,33,34,35,36,252 ]; //Elite
//        $posts[4]= [ 251,31,33,32,252 ]; //Open
//        $posts[5]= [ 251,31,33,32,252 ]; //Veterani
//        $posts[6]= [ 251,31,33,32,252 ]; //Feminin
//        $posts[7]= [ 251,31,33,32,252 ]; //Seniori


        function UUIDWithSpaces($uuid) {
            return preg_replace("/\B(?=(?:[0-9A-F]{2})+\b)/", ' ', $uuid);
        }


        $get_posts = RaidmontanStationsStages::All();

        foreach ($get_posts as $key => $gets){

            if($gets->category_id == 1){
                $posts[1][] = $gets->post;
            }
            if($gets->category_id == 2){
                $posts[2][] = $gets->post;
            }
            if($gets->category_id == 3){
                $posts[3][] = $gets->post;
            }
            if($gets->category_id == 4){
                $posts[4][] = $gets->post;
            }
            if($gets->category_id == 5){
                $posts[5][] = $gets->post;
            }
            if($gets->category_id == 6){
                $posts[6][] = $gets->post;
            }
            if($gets->category_id == 7){
                $posts[7][] = $gets->post;
            }
        }


        if ($request->hasFile('import_file')) {
            echo "<pre>";
            $path = $request->file('import_file')->getRealPath();
            $uuid_from_file = "FF FF FF FF";
            $data = array();

            //take data from file
            if ($file = fopen($path, "r")) {
                while(!feof($file)) {
//                    $line = str_replace(' ','',fgets($file));
                    $line = fgets($file);

                    if( empty(trim($line)) )
                    {
                        continue;
                    }

                    if(str_starts_with($line, '>')){
                        echo "<h2><font color='red'><strong>";
                        echo "Ceasul cu UUID " . $uuid_from_file . " nu are date valide.</br />";
                        echo "Te rugam sa stergi inregistrarea pentru acest ceas din fisierul text sau sa verifici daca este o eroare de validare.";
                        echo "</stroing></font></h2>";
                        fclose($file);
                        die();
                    }

                    if(substr( $line, 0, 5 ) === "Card:"){

                        $uuid_from_file = substr($line,6,11);
                        $uuid_from_db = UuidRaid::where('name',$uuid_from_file)->first();

                        // Verificare daca UUID-ul exista in baza de date sau asociat unei echipe
                        if(!empty($uuid_from_db)) {
                            $echipa = Team::where('uuid_card_raid_id',$uuid_from_db->id)->first();
                            if($echipa === NULL){
                                echo "<h2><font color='red'><strong>";
                                echo 'EROARE!!! - Ceasul cu numarul ' . $uuid_from_db->id . " nu este asociat nici unei echipe." .  " UUID CARD " . $uuid_from_db->name . ".";
                                echo "<br />";
                                echo "Va rugam sa verificati ceasul si sa il asociati unei echipe sau sa stergeti inregistrarea din fisierul text.";
                                echo "<br />";
                                echo "Importul datelor nu poate fi realizat complet";
                                echo "</stroing></font></h2>";
                                fclose($file);
                                die();
                            }
                        } else {
                            echo "<h2><font color='red'><strong>";
                            echo "Ceasul cu UUID " . $uuid_from_file . " nu exista in baza de date. Ceasul nu se regaseste in LISTA CU UUID-uri.";
                            echo "<br />";
                            echo "Acest ceas este folosit pentru teste? Te rugam sa stergi inregistrarea pentru acest ceas din fisierul text.";
                            echo "<br />";
                            echo "Importul datelor nu poate fi realizat complet";
                            echo "</stroing></font></h2>";
                            fclose($file);
                            die('');
                        }

                        // UUID-uri din fisier ca si categorie echipa

                        $uuid_categorie = $posts[$echipa['category_id']];
                        $team_name = $echipa->name;
                        $team_id = $echipa->id;
                        $clock_number = $echipa->uuid_card_raid_id;
                        $category_id = $echipa->category_id;


                        // Array pentru fiecare UUID
                        $data[$uuid_from_file]['category'] = $uuid_categorie;
                        $data[$uuid_from_file]['category_id'] = $category_id;
                        $data[$uuid_from_file]['team_name'] = $team_name;
                        $data[$uuid_from_file]['team_id'] = $team_id;
                        $data[$uuid_from_file]['clock_number'] = $clock_number;
                        $data[$uuid_from_file]['uuid_code'] = $uuid_from_file;

                        switch ($category_id) {
                            case "1":
                                $data[$uuid_from_file]['category_name'] = "FAMILY";
                                break;
                            case "2":
                                $data[$uuid_from_file]['category_name'] = "JUNIOR";
                                break;
                            case "3":
                                $data[$uuid_from_file]['category_name'] = "ELITE";
                                break;
                            case "4":
                                $data[$uuid_from_file]['category_name'] = "OPEN";
                                break;
                            case "5":
                                $data[$uuid_from_file]['category_name'] = "VETERANI";
                                break;
                            case "6":
                                $data[$uuid_from_file]['category_name'] = "FEMININ";
                                break;
                            case "7":
                                $data[$uuid_from_file]['category_name'] = "SENIORI";
                                break;
                            default:
                                $data[$uuid_from_file]['category_name'] = "NONE";
                        }


                    } else {


                        // Grupare post/timestamp/data si creare array

                        $parts = explode(",",$line);

                        foreach ( $parts as $key => $part )
                        {
                            if( trim($parts[$key]) == '%' || $key % 2 != 0  )
                            {
                                continue;
                            }

                            $data[$uuid_from_file][] = array( "post"=> $parts[$key], "time" => $parts[$key+1]);

                        }

                    }

                }

                fclose($file);
            }


            // clean up db
            RaidmontanParticipations::query()->truncate();
            RaidmontanParticipationsEntries::query()->truncate();

            // add abandon to all
            $this->raidmontan_seed_intern();

            echo "<pre>";

            //check data
            if (!empty($data)) {

                foreach ($data as $cardUuid => $time_and_posts ) {
                    $number_pa = 0;

                    echo "\n<strong>#### Informatii Echipa <u>". $time_and_posts['team_name'] . "</u>, Ceas NR." . $time_and_posts['clock_number'] . ", UUID  " . $time_and_posts['uuid_code'] . ", Categorie " . $time_and_posts['category_name'] . " ####</strong>";
                    echo "<br />";


                    $category = [];
                    $missing_posts = [];
                    $valid_posts = [];

                    if (!empty($time_and_posts['category'])) {
                        $category = $time_and_posts['category'];
                        unset($time_and_posts['category']);
                    }

                    if (!empty($time_and_posts['team_name'])) {
                        unset($time_and_posts['team_name']);
                    }

                    if (!empty($time_and_posts['clock_number'])) {
                        unset($time_and_posts['clock_number']);
                    }

                    if (!empty($time_and_posts['uuid_code'])) {
                        unset($time_and_posts['uuid_code']);
                    }

                    if (!empty($time_and_posts['category_name'])) {
                        unset($time_and_posts['category_name']);
                    }


                    $total_posts = count($category);
                    $number_of_posts_taked = count($time_and_posts);

                    $start_time = 0;
                    $final_time = 0;

            
          
                    foreach ( $time_and_posts as $order => $time_and_post )
                    {
        
                        if($order == "category_id" || $order == "team_id")
                        {
                            //invalid post
                            continue;
                        }

                        if( empty($valid_posts[$time_and_post['post']]['arrived']) )
                        {
                            $valid_posts[$time_and_post['post']]['arrived'] = $time_and_post['time'];
                        }
                        else
                        {
                            $valid_posts[$time_and_post['post']]['go'] = $time_and_post['time'];
                        }

                    }

                    if( count($category) !== count($valid_posts) )
                    {
                        $missing_posts = array_diff($category,array_keys($valid_posts));
                    }

                    $uuid_raid = UuidRaid::where('name','=',$cardUuid)->first();
                    $uuid_raid_id = 0;
                    if( !empty($uuid_raid->uuid_id) )
                    {
                        $uuid_raid_id = $uuid_raid->uuid_id;
                    }

                    $participants = RaidmontanParticipations::where('team_id',$time_and_posts['team_id'])->get();

                    foreach ( $participants as $participant )
                    {
                        $participation_entries = RaidmontanParticipationsEntries::where('team_id',$participant->team_id)->where('hits', '=',NULL)->get();

                        $index = 0;
                        foreach ( $valid_posts as $post => $valid_post )
                        {

                            if(count($missing_posts) == 0){


                                $chanllenge_stations_stages = RaidmontanStationsStages::where('post',$post)->where('category_id',$time_and_posts['category_id'])->first();

                                $time = ( !empty($chanllenge_stations_stages['time']) ) ? $chanllenge_stations_stages['time'] : null;
                                $arrived = ( !empty($valid_post['arrived']) ) ? $valid_post['arrived'] : null;
                                $go = ( !empty($valid_post['go']) ) ? $valid_post['go'] : null;
                                $raidmontan_stations_stages_id = ( !empty($chanllenge_stations_stages['id']) ) ? $chanllenge_stations_stages['id'] : null;
    
                                if( !empty($time) )
                                {
                                    //timpul de start plus timp de stat in post
                                    $outside_time = strtotime('+'.$time.'minutes',$arrived);
    
                                    //daca a stat mai mult in post timpul de plecare il punem cu timpul de start plus timpul care trebuia sa stea
                                    if( $go > $outside_time )
                                    {
                                        $go = $outside_time;
                                    }
                                }
                                //daca nu are timp de plecare se pune timpul la care a sosit( se crede ca nu a stat in post si a plecat direct )
                                if( empty($go) && $post != 252 )
                                {
                                    $go = $arrived;
                                }
    
                                $values = [];
    

                                if($post == 252 )
                                {
                                    $go = $arrived;
                                    $arrived = $go;
                                }
                                
                                $values['time_start'] = "00:00:00";
                                if( !empty($arrived) )
                                {
                                    $values['time_start'] = date('H:i:s',$arrived);
                                }
    
                                $values['time_finish'] = "00:00:00";
                                if( !empty($go) )
                                {
                                    $values['time_finish'] = date('H:i:s',$go);
                                }
    
                                //$time_minus_pauses = [];
    
                            }


                            if(empty($missing_posts)){

                                // get

                                //update
                                DB::table('raidmontan_participations_entries')
                                    ->where('team_id', $time_and_posts['team_id'])
                                    ->where('raidmontan_stations_stages_id', $raidmontan_stations_stages_id)
                                    ->update($values);

                                DB::table('raidmontan_participations')
                                    ->where('team_id', $time_and_posts['team_id'])
                                    ->update(['abandon' => 0]);

                                if ($post == '251'){
                                    echo "</br >";
                                    echo "Start: " . $values['time_start'];
                                    $total_timp_team_start = $values['time_start'];
                                } elseif ($post == '252'){
                                    echo "Finish: " . $values['time_finish'];
                                    $total_timp_team_finish = $values['time_finish'];
                                } else {
                                    if($values['time_start'] === $values['time_finish']){
                                        //echo 'Cod PA: ' . $post .' Sosire: ' .  $values['time_start'];
                                        echo 'PA: ' . $number_pa .' Sosire: ' .  $values['time_finish'];

                                        $finish_pa = strtotime($values['time_finish']);
                                        $start_pa = strtotime($values['time_start']);
                                        $time_minus_pauses[$uuid_raid_id][]['time'] = $finish_pa - $start_pa;

                                    } else {
                                        echo 'PA: ' . $number_pa .' <strong> -></strong> Sosire: ' .  $values['time_start'] . ' <strong> -></strong> Plecare: ' . $values['time_finish'];

                                        $finish_pa = strtotime($values['time_finish']);
                                        $start_pa = strtotime($values['time_start']);

                                        $time_minus_pauses[$uuid_raid_id][]['time'] = $finish_pa - $start_pa;


                                    }
                                }

                                echo "<br />";

                                $number_pa++;
                            }
                            $index++;
                        }
                    }



                    if( empty($missing_posts) )
                    {
                        echo '<br/>';
                        $f1 = strtotime($total_timp_team_finish);
                        $s1 = strtotime($total_timp_team_start);
                        $finish_start_diff = $f1 - $s1;
                        echo 'Timp Total: <strong>' . date('H:i:s', $finish_start_diff) . "</strong> cu pauze.</font>";
                        echo '<br />';

                        // foreach ($time_minus_pauses[$uuid_raid_id] as $key => $times){
                        //     $time_minus_pauses_total = 0;
                        //     foreach ($times as $time){
                        //         var_dump("$time " . $time);
                        //         $time_minus_pauses_total += $time;                            
                        //     }
                        // }
                        // echo 'Timp Total: <strong>' . date('H:i:s',$finish_start_diff - $time_minus_pauses_total) . "</strong> fara pauze.</font>";
                    }
                    else
                    {
                        echo '<br/>';
                        echo '<font color=\'red\'><strong>PA lipsa sau Abandon</strong> ';

                    //    foreach ( $missing_posts as $missing_post )
                    //    {
                    //        echo $missing_post . " ";

                    //    }

                        $missing_posts_implode = implode(",", $missing_posts);
                        $missing_posts_text = ( empty($missing_posts) ) ? '' : $missing_posts_implode;
                        $count_pa_missings =  'regaseste';
                        if(count($missing_posts) > 1){
                            $count_pa_missings =  "regasesc";
                        } else {
                            $count_pa_missings =  "regaseste";
                        }
                        echo '<br/>';
                        echo "PA " . $missing_posts_text . " nu se " . $count_pa_missings . " pe card";

                        // echo "PA nu se " . $count_pa_missings . " pe card";

                        echo '</font>';

                    }

                    echo "<br />";
                    echo "\n########################################  END ########################################";
                    echo "<br />";



//                    foreach ($time_and_posts as $order => $time_and_post )
//                    {
//                        dd($time_and_post);
//
//
////
//
//                    }
//                }
//                die();
//                return redirect('/import-orienteering')->with('success', 'UUID Cards from file has imported successed.');
                }
            }

        }
    }


    public function orienteering_import_uuids(Request $request)
    {


        $this->validate($request, [

            'import_file' => 'required'

        ]);

        $uuidlist = UuidOrienteeting::All();
        $teams = Team::all();

//        $posts[1]= [ 251,31,32,33,252 ]; //Family
//        $posts[2]= [ 251,31,33,33,252 ]; //Juniori
//        $posts[3]= [ 251,31,32,33,34,35,36,252 ]; //Elite
//        $posts[4]= [ 251,31,33,32,252 ]; //Open
//        $posts[5]= [ 251,31,33,32,252 ]; //Veterani
//        $posts[6]= [ 251,31,33,32,252 ]; //Feminin
//        $posts[7]= [ 251,31,33,32,252 ]; //Seniori


        function UUIDWithSpaces($uuid) {
            return preg_replace("/\B(?=(?:[0-9A-F]{2})+\b)/", ' ', $uuid);
        }


        $get_posts = OrienteeringStationsStages::All();


        foreach ($get_posts as $key => $gets){
            if($gets->category_id == 1){
                $posts[1][] = $gets->post;
            }
            if($gets->category_id == 2){
                $posts[2][] = $gets->post;
            }
            if($gets->category_id == 3){
                $posts[3][] = $gets->post;
            }
            if($gets->category_id == 4){
                $posts[4][] = $gets->post;
            }
            if($gets->category_id == 5){
                $posts[5][] = $gets->post;
            }
            if($gets->category_id == 6){
                $posts[6][] = $gets->post;
            }
            if($gets->category_id == 7){
                $posts[7][] = $gets->post;
            }
        }

        if ($request->hasFile('import_file')) {
            echo "<pre>";
            $path = $request->file('import_file')->getRealPath();
            $uuid_from_file = "FF FF FF FF";
            $data = array();

            //take data from file
            if ($file = fopen($path, "r")) {
                while(!feof($file)) {
//                    $line = str_replace(' ','',fgets($file));
                    $line = fgets($file);

                    if( empty(trim($line)) )
                    {
                        continue;
                    }

                    if(substr( $line, 0, 5 ) === "Card:"){

                        $uuid_from_file = substr($line,6,11);
                        $uuid_from_db = UuidOrienteeting::where('name',$uuid_from_file)->first();

                        // Verificare daca UUID-ul exista in baza de date sau asociat unei echipe
                        if(!empty($uuid_from_db)) {
                            $echipa = Team::with('orienteering')->where('uuid_card_orienteering_id',$uuid_from_db->id)->first();
                            if($echipa === NULL){
                                echo "<h2><font color='red'><strong>";
                                echo 'EROARE!!! - Ceasul cu numarul ' . $uuid_from_db['uuid_id'] . " nu este asociat nici unei echipe." .  " UUID CARD " . $uuid_from_db['uuid_name'] . ".";
                                echo "<br />";
                                echo "Va rugam sa verificati ceasul si sa il asociati unei echipe sau sa stergeti inregistrarea din fisierul text.";
                                echo "<br />";
                                echo "Importul datelor nu poate fi realizat complet";
                                echo "</stroing></font></h2>";
                                die();
                            }
                        } else {
                            echo "<h2><font color='red'><strong>";
                            echo "Ceasul cu UUID " . $uuid_from_file . " nu exista in baza de date. Ceasul nu se regaseste in LISTA CU UUID-uri.";
                            echo "<br />";
                            echo "Acest ceas este folosit pentru teste? Te rugam sa stergi inregistrarea pentru acest ceas din fisierul text.";
                            echo "<br />";
                            echo "Importul datelor nu poate fi realizat complet";
                            echo "</stroing></font></h2>";
                            die('');
                        }

                        // UUID-uri din fisier ca si categorie echipa

                        $uuid_categorie = $posts[$echipa->category_id];
                        $team_name = $echipa->name;
                        $team_id = $echipa->id;
                        $clock_number = $uuid_from_db->id;
                        $category_id = $echipa->category_id;


                        // Array pentru fiecare UUID
                        $data[$uuid_from_file]['category'] = $uuid_categorie;
                        $data[$uuid_from_file]['team_name'] = $team_name;
                        $data[$uuid_from_file]['team_id'] = $team_id;
                        $data[$uuid_from_file]['clock_number'] = $clock_number;
                        $data[$uuid_from_file]['uuid_code'] = $uuid_from_file;

                        switch ($category_id) {
                            case "1":
                                $data[$uuid_from_file]['category_name'] = "FAMILY";
                                break;
                            case "2":
                                $data[$uuid_from_file]['category_name'] = "JUNIOR";
                                break;
                            case "3":
                                $data[$uuid_from_file]['category_name'] = "ELITE";
                                break;
                            case "4":
                                $data[$uuid_from_file]['category_name'] = "OPEN";
                                break;
                            case "5":
                                $data[$uuid_from_file]['category_name'] = "VETERANI";
                                break;
                            case "6":
                                $data[$uuid_from_file]['category_name'] = "FEMININ";
                                break;
                            case "7":
                                $data[$uuid_from_file]['category_name'] = "SENIORI";
                                break;
                            default:
                                $data[$uuid_from_file]['category_name'] = "NONE";
                        }



                    } else {
                        // Grupare post/timestamp/data si creare array
                        $parts = explode(",",$line);

                        foreach ( $parts as $key => $part )
                        {
                            if( trim($parts[$key]) == '%' || $key % 2 != 0  )
                            {
                                continue;
                            }

                            $data[$uuid_from_file][] = array( "post"=> $parts[$key], "time" => $parts[$key+1]);

                        }

                    }

                }

                fclose($file);
            }

            echo "<pre>";

            $team_id = 0;
            //check data
            if (!empty($data)) {

                foreach ($data as $cardUuid => $time_and_posts ) {

                    echo "\n<strong>#### Informatii Echipa <u>". $time_and_posts['team_name'] . "</u>, Ceas NR." . $time_and_posts['clock_number'] . ", UUID  " . $time_and_posts['uuid_code'] . ", Categorie " . $time_and_posts['category_name'] . " ####</strong>";
                    echo "<br />";


                    $category = [];
                    $missing_posts = [];
                    $valid_posts = [];

                    if (!empty($time_and_posts['category'])) {
                        $category = $time_and_posts['category'];
                        unset($time_and_posts['category']);
                    }

                    if (!empty($time_and_posts['team_name'])) {
                        unset($time_and_posts['team_name']);
                    }

                    if (!empty($time_and_posts['team_id'])) {
                        $team_id = $time_and_posts['team_id'];
                        unset($time_and_posts['team_id']);
                    }

                    if (!empty($time_and_posts['clock_number'])) {
                        unset($time_and_posts['clock_number']);
                    }

                    if (!empty($time_and_posts['uuid_code'])) {
                        unset($time_and_posts['uuid_code']);
                    }

                    if (!empty($time_and_posts['category_name'])) {
                        unset($time_and_posts['category_name']);
                    }


                    $total_posts = count($category);
                    $number_of_posts_taked = count($time_and_posts);


                    $start_time = 0;
                    $final_time = 0; 

                    
                    $count = 0;

                    $posts_order = $category;
                    $posts_order_final = [];


                    // search if the order of posts are correct
                    foreach($time_and_posts as $key => $post){
                        if((int)$post['post'] == $posts_order[0]){
                            unset($posts_order[0]);
                            \array_splice($posts_order, 0, 0);
                        } else {
                            continue;
                        }

                    }

                    $missing_posts = $posts_order;

                    if( empty($missing_posts) )
                    {

                        for ($i = 0; $i < $total_posts; $i++) {

                            foreach ($time_and_posts as $order => $time_and_post) {
    
                                if ($time_and_post['post'] == $category[$i] ) {
    
                                    if( $time_and_post['post'] == 251 && $start_time == 0 )
                                    {
                                        $start_time = $time_and_post['time'];
                                    }
    
                                    if( $time_and_post['post'] == 252 && $final_time == 0 )
                                    {
                                        $final_time = $time_and_post['time'];
                                    }
    
                                    if(  $i != 0  )
                                    {
                                        if ( isset($valid_posts[$category[$i-1]]) && $time_and_post['time'] >= $valid_posts[$category[$i-1]]  )
                                        {
                                            if( empty($valid_posts[$time_and_post['post']]) )
                                            {
                                                $valid_posts[$time_and_post['post']] = $time_and_post['time'];
                                            }
                                            break;
                                        }
                                    }
                                    else
                                    {
                                        if( empty($valid_posts[$time_and_post['post']]) )
                                        {
                                            $valid_posts[$time_and_post['post']] = $time_and_post['time'];
                                        }
                                        break;
                                    }
    
                                }
    
                                if ($number_of_posts_taked - 1 == $order) {
                                    $missing_posts[] = $category[$i];
                                }
                            }
    
                        }


                        echo "\n<font color='green'>Au fost validate toate posturile.";
                        echo '<br/>';
                        echo 'Timp Total: ' . date('H:i:s',$final_time - $start_time) . "</font>";
                    }
                    else
                    {
                        echo '<br/>';
                        echo '<font color=\'red\'><strong>Ordine Gresita Posturi</strong> ';

                        // foreach ( $missing_posts as $missing_post )
                        // {
                        //     if($missing_post == 251){
                        //         $missing_post = "S";
                        //     }
                        //     if($missing_post == 252){
                        //         $missing_post = "F";
                        //     }
                        //     echo $missing_post . " ";

                        // }
                        echo '</font>';
                        echo '<br/><br/>';


                        echo '<strong>Ordine Corecta: </strong>';
                        foreach ( $category as $item )
                        {
                            if($item == 251){
                                $item = "S";
                            }
                            if($item == 252){
                                $item = "F";
                            }
                            echo $item . " ";
                        }

                        echo '<br/>';
                        echo '<br/>';

                        echo '<strong>Ordine Posturi Echipa:</strong>';
                        echo '<br/>';

                        foreach ( $time_and_posts as $order => $value )
                        {
                            if($value['post'] == 251){
                                $value['post'] = "S";
                            }
                            if($value['post'] == 252){
                                $value['post'] = "F";
                            }
                            echo 'Post: '.$value['post'].' time: '.date('H:i:s',$value['time']);
                            echo '<br/>';

                        }
                    }


                    $missing_posts = implode(",", $missing_posts);
//                    var_dump($missing_posts);

//                    $missing_posts_text = ( empty($missing_posts) ) ? '' : json_encode($missing_posts);
                    $missing_posts_text = ( empty($missing_posts) ) ? '' : $missing_posts;

                    if(empty($missing_posts_text)){
                        DB::table('orienteering')
                            ->where('team_id', $team_id)
                            ->update(['start_time' => date('H:i:s',$start_time), 'finish_time' => date('H:i:s',$final_time), 'total_time' => date('H:i:s',$final_time - $start_time), 'abandon' => 0, 'missed_posts' => $missing_posts_text, 'order_posts' => json_encode($time_and_posts)]);
                    } else {
                        DB::table('orienteering')
                            ->where('team_id', $team_id)
                            ->update(['start_time' => date('H:i:s',$start_time), 'finish_time' => date('H:i:s',$final_time), 'total_time' => date('H:i:s',$final_time - $start_time), 'abandon' => 2, 'missed_posts' => $missing_posts_text, 'order_posts' => json_encode($time_and_posts)]);
                    }



                    echo "<br />";
                    echo "\n########################################  END ########################################";
                    echo "<br />";

                }
            }

        }
    }


}
