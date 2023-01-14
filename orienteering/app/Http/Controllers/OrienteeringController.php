<?php

namespace App\Http\Controllers;

use App\Models\Orienteering;
use App\Models\Team;
use App\Models\UuidCardOrienteering;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;
use Excel;
use PDF;
use Input;
use App\Models\OrienteeringPosts;

class OrienteeringController extends Controller
{

    public function index() {

        $teams = Team::All()->count();
        $orienteering = Orienteering::All()->count();


        return view('orienteering.index', ['teams' => $teams, 'orienteering' => $orienteering,]);
    }

    public function configure() {

        $nr = 1;
        $orienteering_post_1 = OrienteeringPosts::where('categories_id', 1)->WhereNotIn('post', [251,252])->get();
        $orienteering_post_2 = OrienteeringPosts::where('categories_id', 2)->WhereNotIn('post', [251,252])->get();
        $orienteering_post_3 = OrienteeringPosts::where('categories_id', 3)->WhereNotIn('post', [251,252])->get();
        $orienteering_post_4 = OrienteeringPosts::where('categories_id', 4)->WhereNotIn('post', [251,252])->get();
        $orienteering_post_5 = OrienteeringPosts::where('categories_id', 5)->WhereNotIn('post', [251,252])->get();
        $orienteering_post_6 = OrienteeringPosts::where('categories_id', 6)->WhereNotIn('post', [251,252])->get();
        $orienteering_post_7 = OrienteeringPosts::where('categories_id', 7)->WhereNotIn('post', [251,252])->get();


        return view('orienteering.configure', ['nr' => $nr, 'orienteering_post_1' => $orienteering_post_1, 'orienteering_post_2' => $orienteering_post_2, 'orienteering_post_3' => $orienteering_post_3 , 'orienteering_post_4' => $orienteering_post_4 , 'orienteering_post_5' => $orienteering_post_5 , 'orienteering_post_6' => $orienteering_post_6, 'orienteering_post_7' => $orienteering_post_7]);
    }

    public function configure_store() {


        $categories_id = $_POST['categories_id'];
        DB::table('orienteering_stages')->where('categories_id', $categories_id)->delete();
        $posts = $_POST['post'][$categories_id];

        foreach ($posts as $key => $post_value){
            OrienteeringPosts::insert(
                ['categories_id' => $categories_id, 'post' => $post_value]
            );
        }
        return redirect('/configure')->with('success', 'Datele au fost salvate' . $categories_id);

    }


    /**
     * Populate Orienteering with data fake to import csv
     */


    public function seedorienteering(){

        $teams = Team::all();

        foreach ($teams as $team) {

            $team_id = $team->team_id;
            $uuid_card = $team->uuid_card;

            $exists = DB::table('orienteering')->where('team_id', $team_id)->first();

            if(!$exists) {

                DB::table('orienteering')
                    ->insert(['team_id' => $team_id, 'uuid_card' => $uuid_card, 'name_participant' => '-', 'start' => '00:00:00', 'finish' => '00:00:00', 'total' => '00:00:00', 'abandon' => 1, 'missed_posts' => 0]);

            }
        }

        return redirect('/import-orienteering')->with('success', 'Tabela pentru proba orientare a fost populata. Acum puteti importa CSV-ul. Atentie daca la o echipa va ramane finish si total 00:00:00 si Abandon inseama ca acesta nu se regaseste in fisierul importat sau a abandonat');

    }

    public function importuuidcardorienteering(Request $request)
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


        $get_posts = OrienteeringPosts::All();


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
                        $uuid_from_db = UuidCardOrienteering::where('uuid_name',$uuid_from_file)->first();

                        // Verificare daca UUID-ul exista in baza de date sau asociat unei echipe
                        if(!empty($uuid_from_db)) {
                            $echipa = Team::where('uuid_card',$uuid_from_db['uuid_id'])->first();
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
                        $clock_number = $echipa->uuid_card;
                        $category_id = $echipa->category_id;




                        // Array pentru fiecare UUID
                        $data[$uuid_from_file]['category'] = $uuid_categorie;
                        $data[$uuid_from_file]['team_name'] = $team_name;
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



                    if( empty($missing_posts) )
                    {

                        echo "\n<font color='green'>Au fost validate toate posturile.";
                        echo '<br/>';
                        echo 'Timp Total: ' . date('H:i:s',$final_time - $start_time) . "</font>";
                    }
                    else
                    {
                        echo '<br/>';
                        echo '<font color=\'red\'><strong>Ordine Gresita Posturi:</strong> ';

                        foreach ( $missing_posts as $missing_post )
                        {
                            echo $missing_post . " ";

                        }
                        echo '</font>';
                        echo '<br/><br/>';


                        echo '<strong>Ordine Corecta esta: </strong>';
                        foreach ( $category as $item )
                        {
                            echo $item . " ";
                        }

                        echo '<br/>';
                        echo '<br/>';

                        echo '<strong>Ordine Posturi Echipa:</strong>';
                        echo '<br/>';

                        foreach ( $time_and_posts as $order => $value )
                        {
                            echo 'Post: '.$value['post'].' time: '.date('H:i:s',$value['time']);
                            echo '<br/>';

                        }
                    }


                    $missing_posts = implode(",", $missing_posts);
//                    var_dump($missing_posts);

//                    $missing_posts_text = ( empty($missing_posts) ) ? '' : json_encode($missing_posts);
                    $missing_posts_text = ( empty($missing_posts) ) ? '' : $missing_posts;

                    $uuid_from_db = UuidCardOrienteering::where('uuid_name',$cardUuid)->first();
                    if( !empty($uuid_from_db) )
                    {

                        DB::table('orienteering')
                            ->where('uuid_card', $uuid_from_db['uuid_id'])
                            ->update(['start' => date('H:i:s',$start_time), 'finish' => date('H:i:s',$final_time), 'total' => date('H:i:s',$final_time - $start_time), 'abandon' => 0, 'missed_posts' => $missing_posts_text, 'order_posts' => json_encode($time_and_posts)]);

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
