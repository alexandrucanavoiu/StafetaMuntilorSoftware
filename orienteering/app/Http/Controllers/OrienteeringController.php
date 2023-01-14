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

class OrienteeringController extends Controller
{

    public function index() {

        $teams = Team::All()->count();
        $orienteering = Orienteering::All()->count();


        return view('orienteering.index', ['teams' => $teams, 'orienteering' => $orienteering,]);
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

    /**
     * Import time for Participant Orienteering using UUID CARDS system
     */
//    public function importuuidcardorienteering(Request $request)
//    {
//
//
//        $this->validate($request, [
//
//            'import_file' => 'required'
//
//        ]);
//
//        $uuidlist = UuidCardOrienteering::All();
//
//        //print_r($uuidlist);
//        //die();
//        if (Input::hasFile('import_file')) {
//
//            $path = Input::file('import_file')->getRealPath();
//
//            $data = Excel::load($path, function ($reader) {
//                $reader->noHeading();
//            })->get();
//
//
//            if (!empty($data) && $data->count()) {
//                foreach ($data as $key => $value) {
//                    $cell_items = $value->toArray();
//                    if($cell_items[1] == "ERROR !!") {
//                        $cell_items[1] = "00:00:00";
//                        $abandon = 0;
//                        $missed_posts = 1;
//
//                    } else {
//                        $abandon = 0;
//                        $missed_posts = 0;
//                    }
//                    $insert[] = ['uuid_card' => $cell_items[0], 'finish' => $cell_items[1], 'total' => $cell_items[1], 'abandon' => $abandon, 'missed_posts' => $missed_posts];
//
//                }
//
//
//                if (!empty($insert)) {
//
//
//                    foreach ($insert as $data) {
//
//                        foreach ($uuidlist as $uuid) {
//
//
//                            if($data['uuid_card'] === $uuid->uuid_name) {
//
//                                DB::table('orienteering')
//                                    ->where('uuid_card', $uuid->uuid_id)
//                                    ->update(['start' => "00:00:00", 'finish' => $data['finish'], 'total' => $data['finish'], 'abandon' => $data['abandon'], 'missed_posts' => $data['missed_posts']]);
//                            }
//
//                        }
//                    }
//
//                    return redirect('/import-orienteering')->with('success', 'UUID Cards from file has imported successed.');
//
//                }
//            }
//        }
//        return back();
//    }

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
//


$posts[1]=[251,45,38,46,39,40,100,252];
$posts[2]=[251,41,43,44,34,47,45,35,38,46,39,40,100,252];
$posts[3]=[251,10,15,31,32,33,34,36,37,39,40,42,44,45,46,252];
$posts[4]=[251,47,45,35,38,46,37,39,40,100,252];
$posts[5]=[251,41,43,44,34,47,45,35,38,46,39,40,100,252];
$posts[6]=[251,41,42,43,44,34,36,35,37,39,40,100,252];
$posts[7]=[251,41,42,43,44,34,36,35,37,39,40,100,252];


        //print_r($uuidlist);
        //die();
        if (Input::hasFile('import_file')) {
echo "<pre>";
            $path = Input::file('import_file')->getRealPath();
            $card = "FFFFFFFF";
            if ($file = fopen($path, "r")) {
                while(!feof($file)) {
                    $line = fgets($file);
                    echo "===$line====";
                    if(substr( $line, 0, 5 ) === "Card:"){
                        $card = substr($line,5,8);
                        $tmp2 = UuidCardOrienteering::where('uuid_name',$card)->first();
                        print_r($tmp2['uuid_id']);
                        $tmp3 = Team::where('uuid_card',$tmp2['uuid_id'])->first();
                        print_r($tmp3);
                        $posturi = $posts[$tmp3['category_id']];
                         $data[$card]=array();
                    } else {
                        $parts = explode(",",$line);
                        if(count($parts) == 3){
                           
                            $data[$card][]=array( "post"=> $parts[0], "time" => $parts[1])  ;    
                        }
                        
                    }
                    if(substr( $line, 0, 1 ) === "%"){
                        echo "stop";
                            //print_r(array_reverse($data[$card]));
                            foreach(array_reverse($data[$card]) as $k=> $v){
                                 
                                    echo "\n---   -- $k --- ". $v['post']." --- ". $v['time'];
                                    
                                    $datatmp[$v['post']]=$v['time'];
                                 
                            }
            print_r($datatmp);                
                            
                            $prev_time = 0;
                            $missing= array();
                            $start=0;
                            $finish=0;
                        foreach($posturi as $post){  

//echo "+++ $post ++";
                            if( array_key_exists($post,$datatmp)){
                                if($post == 251) { $start = $datatmp[$post] ; $prev_time=$start ; }
                                if($post == 252)  $finish = $datatmp[$post] ;
                                
                                echo "\n $post ".$datatmp[$post]. "----" .($datatmp[$post] - $prev_time);
                                if($datatmp[$post] < $prev_time){
                                    echo "\nError...";
                                    $missing[]=$post;
                                }
                                $prev_time = $datatmp[$post];
                            }  else {
                                $missing[]=$post;
                                echo "\nMissing $post";
                            }
                            
                        
                        }
                        print_r($missing);
                       // die();
                        
                        $insert[] = ['uuid_card' => $card, 'start'=>date("H:i:s",$start), 'finish' =>date("H:i:s", $finish), 'total' => date("H:i:s",$finish-$start), 'abandon' => 0, 'missed_posts' => implode(",",$missing)];
                        
                    }
                    # do same stuff with the $line
                }
                fclose($file);
            }
echo "<pre>";
            
            print_r($missing);
            print_r($insert);
            
            //die();


                if (!empty($insert)) {


                    foreach ($insert as $data) {

                        foreach ($uuidlist as $uuid) {


                            if($data['uuid_card'] === $uuid->uuid_name) {
                                print_r($uuid->uuid_id);
                                DB::table('orienteering')
                                    ->where('uuid_card', $uuid->uuid_id)
                                    ->update(['start' => $data['start'], 'finish' => $data['finish'], 'total' => $data['total'], 'abandon' => $data['abandon'], 'missed_posts' => $data['missed_posts']]);
                            }

                        }
                    }
                    die();
                    return redirect('/import-orienteering')->with('success', 'UUID Cards from file has imported successed.');

                }
            
        }
        return back();
    }



}