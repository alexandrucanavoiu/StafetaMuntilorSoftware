<?php

namespace App\Http\Controllers;

use App\Models\ChallengeStations;
use App\Models\ChallengeStationsStages;
use App\Models\Participations;
use App\Models\ParticipationsEntries;
use App\Models\RaidMontanPosts;
use App\Models\Team;
use App\Models\UuidCardOrienteering;
use App\Models\UuidCardRaidMontan;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;
use Excel;
use PDF;
use Input;

class RaidMontanController extends Controller
{

    public function index() {

        $teams = Team::All()->count();
        $participations = Participations::All()->count();


        return view('raid_montan.index', ['teams' => $teams, 'participations' => $participations,]);
    }

    public function configure() {

        $nr = 1;
        $raidmontan_post_1 = RaidMontanPosts::where('categories_id', 1)->get();
        $raidmontan_post_2 = RaidMontanPosts::where('categories_id', 2)->get();
        $raidmontan_post_3 = RaidMontanPosts::where('categories_id', 3)->get();
        $raidmontan_post_4 = RaidMontanPosts::where('categories_id', 4)->get();
        $raidmontan_post_5 = RaidMontanPosts::where('categories_id', 5)->get();
        $raidmontan_post_6 = RaidMontanPosts::where('categories_id', 6)->get();
        $raidmontan_post_7 = RaidMontanPosts::where('categories_id', 7)->get();


        return view('raid_montan.configure', ['nr' => $nr, 'raidmontan_post_1' => $raidmontan_post_1, 'raidmontan_post_2' => $raidmontan_post_2, 'raidmontan_post_3' => $raidmontan_post_3 , 'raidmontan_post_4' => $raidmontan_post_4 , 'raidmontan_post_5' => $raidmontan_post_5 , 'raidmontan_post_6' => $raidmontan_post_6, 'raidmontan_post_7' => $raidmontan_post_7]);
    }

    public function configure_store() {

        $categories_id = $_POST['categories_id'];
        DB::table('challenge_stations_stages')->where('categories_id', $categories_id)->delete();
        $posts = $_POST['category'][$categories_id];


        foreach ($posts['cod'] as $key => $post_value){

            if($posts['time'][$key] === ''){
                RaidMontanPosts::insert(
                    ['categories_id' => $categories_id, 'post' => $post_value]
                );
            } else {
                RaidMontanPosts::insert(
                    ['categories_id' => $categories_id, 'post' => $post_value, 'time' => $posts['time'][$key]]
                );
            }

        }
        return redirect('/configure-raid-montan')->with('success', 'Datele au fost salvate' . $categories_id);

    }

    public function seedraidmontan(ParticipationsEntries $participationsEntries){

        $teams = Team::all();

        foreach ($teams as $team) {

            $team_id = $team->team_id;
            $uuid_card = $team->uuid_id;
            $uuids_raid_id = $team->uuids_raid_id;
            $category_id = $team->category_id;

            $exists = DB::table('participations')->where('team_id', $team_id)->first();

            if(!$exists) {

                $participant = Participations::create(['team_id' => $team_id, 'category_challenge_id' => $category_id, 'abandonment' => 1]);

                $challange_stations = ChallengeStations::where('category_challenge_id', $category_id)->get();

                $stationsArray = [];

                $posts_from_category_raid =  ChallengeStationsStages::where('categories_id', $category_id)->get();

                $index_post = 0;

                foreach ($challange_stations as $stations){


                    if($stations->station_type == 2){
                        $stationsArray[]  = [
                            'participation_id' => $participant->id,
                            'station_id' => $stations->station_id,
                            'time_start' => '',
                            'time_finish' => '',
                            'hits' => '1',
                            'uuid_id' => $uuids_raid_id,
                        ];
                    } else {
                        $stationsArray[]  = [
                            'participation_id' => $participant->id,
                            'station_id' => $stations->station_id,
                            'time_start' => '',
                            'time_finish' => '',
                            'hits' => '',
                            'post' => $posts_from_category_raid[$index_post]['post'],
                            'uuid_id' => $uuids_raid_id,
                        ];
                        $index_post++;
                    }

                }

                //dd($stationsArray);
                //$participationsEntries->create($stationsArray);

                foreach ($stationsArray as $array_ok){
                    if($array_ok['hits'] === ''){
                        DB::table('participation_entries')
                            ->insert(['participation_id' => $array_ok['participation_id'], 'station_id' => $array_ok['station_id'], 'time_start' => '', 'time_finish' => '', 'post' =>  $array_ok['post'], 'uuid_id' => $array_ok['uuid_id']]);
                    } else {
                        DB::table('participation_entries')
                            ->insert(['participation_id' => $array_ok['participation_id'], 'station_id' => $array_ok['station_id'], 'time_start' => '', 'time_finish' => '', 'hits' => $array_ok['hits'], 'uuid_id' => $array_ok['uuid_id']]);
                    }
                }


            }
        }

        return redirect('/import-raid-montan')->with('success', 'Tabela pentru proba Raid Montan a fost populata. Acum puteti importa CSV-ul. Atentie daca la o echipa va ramane Abandon inseama ca acesta nu se regaseste in fisierul importat sau a abandonat');

    }

    public function importuuidcardraidmontan(Request $request)
    {


        $this->validate($request, [

            'import_file' => 'required'

        ]);

        $uuidlist = UuidCardOrienteering::All();
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


        $get_posts = ChallengeStationsStages::All();


        foreach ($get_posts as $key => $gets){
            if($gets->categories_id == 1){
                $posts[1][] = $gets->post;
            }
            if($gets->categories_id == 2){
                $posts[2][] = $gets->post;
            }
            if($gets->categories_id == 3){
                $posts[3][] = $gets->post;
            }
            if($gets->categories_id == 4){
                $posts[4][] = $gets->post;
            }
            if($gets->categories_id == 5){
                $posts[5][] = $gets->post;
            }
            if($gets->categories_id == 6){
                $posts[6][] = $gets->post;
            }
            if($gets->categories_id == 7){
                $posts[7][] = $gets->post;
            }
        }

        if (Input::hasFile('import_file')) {
            echo "<pre>";
            $path = Input::file('import_file')->getRealPath();
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
                        $uuid_from_db = UuidCardRaidMontan::where('uuid_name',$uuid_from_file)->first();

                        // Verificare daca UUID-ul exista in baza de date sau asociat unei echipe
                        if(!empty($uuid_from_db)) {
                            $echipa = Team::where('uuids_raid_id',$uuid_from_db['uuid_id'])->first();
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

                        $uuid_categorie = $posts[$echipa['category_id']];
                        $team_name = $echipa->team_name;
                        $team_id = $echipa->team_id;
                        $clock_number = $echipa->uuid_card;
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
                        if( !in_array($time_and_post['post'],$category ) )
                        {
                            //invalid post
                            continue;
                        }

                        if( empty($valid_posts[$time_and_post['post']]['start']) )
                        {
                            $valid_posts[$time_and_post['post']]['start'] = $time_and_post['time'];
                        }
                        else
                        {
                            $valid_posts[$time_and_post['post']]['end'] = $time_and_post['time'];
                        }

                    }

                    if( count($category) !== count($valid_posts) )
                    {
                        $missing_posts = array_diff($category,array_keys($valid_posts));
                    }

                    $uuid_raid = UuidCardRaidMontan::where('uuid_name','=',$cardUuid)->first();
                    $uuid_raid_id = 0;
                    if( !empty($uuid_raid->uuid_id) )
                    {
                        $uuid_raid_id = $uuid_raid->uuid_id;
                    }

                    $participants = Participations::where('team_id',$time_and_posts['team_id'])->get();

                    foreach ( $participants as $participant )
                    {
                        $participation_entries = ParticipationsEntries::where('participation_id',$participant['participation_id'])->where('hits', '=',NULL)->get();

                        $index = 0;
                        foreach ( $valid_posts as $post => $valid_post )
                        {

                            $chanllenge_stations_stages = ChallengeStationsStages::where('post',$post)->where('categories_id',$time_and_posts['category_id'])->first();

                            $time = ( !empty($chanllenge_stations_stages['time']) ) ? $chanllenge_stations_stages['time'] : null;
                            $start = ( !empty($valid_post['start']) ) ? $valid_post['start'] : null;
                            $finish = ( !empty($valid_post['end']) ) ? $valid_post['end'] : null;

                            if( !empty($time) )
                            {
                                //timpul de start plus timp de stat in post
                                $outside_time = strtotime('+'.$time.'minutes',$start);

                                //daca a stat mai mult in post timpul de plecare il punem cu timpul de start plus timpul care trebuia sa stea
                                if( $finish > $outside_time )
                                {
                                    $finish = $outside_time;
                                }
                            }

                            //daca nu are timp de plecare se pune timpul la care a sosit( se crede ca nu a stat in post si a plecat direct )
                            if( empty($finish) && $post != 252 && $post != 251 )
                            {
                                $finish = $start;
                            }

                            //daca e finish punem timpul care e primul si e salvat ca start pe finish
                            if( $post == 252 )
                            {
                                $finish = $start;
                                $start = null;
                            }

                            $values = [];

                            if( !empty($start) )
                            {
                                $values['time_start'] = date('H:i:s',$start);
                            }

                            if( !empty($finish) )
                            {
                                $values['time_finish'] = date('H:i:s',$finish);
                            }

                            //$time_minus_pauses = [];

                            if(empty($missing_posts)){

                                //update
                                DB::table('participation_entries')
                                    ->where('uuid_id', $uuid_raid_id)
                                    ->where('post', $post)
                                    ->update($values);

                                DB::table('participations')
                                    ->where('participation_id', $participant['participation_id'])
                                    ->update(['abandonment' => 0]);

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
                                        echo 'PA: ' . $number_pa .' Sosire: ' .  $values['time_start'];

                                        $finish_pa = strtotime($values['time_finish']);
                                        $start_pa = strtotime($values['time_start']);
                                        $time_minus_pauses[$uuid_raid_id][]['time'] = $finish_pa - $start_pa;

                                    } else {
                                        //echo 'Cod PA: ' . $post .' <strong> -></strong> Sosire: ' .  $values['time_start'] . ' <strong> -></strong> Plecare: ' . $values['time_finish'];
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

                        $time_minus_pauses_total = 0;
                        foreach ($time_minus_pauses[$uuid_raid_id] as $key => $times){
                            foreach ($times as $time){
                                $time_minus_pauses_total += $time;
                            }
                        }
                        echo 'Timp Total: <strong>' . date('H:i:s',$finish_start_diff - $time_minus_pauses_total) . "</strong> fara pauze.</font>";
                    }
                    else
                    {
                        echo '<br/>';
                        echo '<font color=\'red\'><strong>PA lipsa sau Abandon</strong> ';

//                        foreach ( $missing_posts as $missing_post )
//                        {
//                            echo $missing_post . " ";
//
//                        }

                        $missing_posts = implode(",", $missing_posts);
                        $missing_posts_text = ( empty($missing_posts) ) ? '' : $missing_posts;
                        $count_pa_missings =  'regaseste';
                        if(count($missing_posts) > 1){
                                $count_pa_missings =  "regasesc";
                        } else {
                                $count_pa_missings =  "regaseste";
                        }
                        echo '<br/>';
                        echo "COD PA " . $missing_posts_text . " nu se " . $count_pa_missings . " pe card";
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




}
