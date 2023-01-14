<?php

namespace App\Http\Controllers;

use App\Models\UuidCardTrail;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;
use Excel;
use PDF;
use Input;

class CrossTrailController extends Controller
{

    public function index() {

        return view('crosstrail.index', compact('stages'));
    }


    /**
     * Import time for Participant CROSS TRAIL using UUID CARDS system
     */
    public function importuuidcardtrail(Request $request)
    {


        $this->validate($request, [

            'import_file' => 'required'

        ]);

        $uuidlist = UuidCardTrail::All();

        if (Input::hasFile('import_file')) {

            $path = Input::file('import_file')->getRealPath();

            $data = Excel::load($path, function ($reader) {
                $reader->noHeading();
            })->get();


            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $cell_items = $value->toArray();

                    if($cell_items[1] == "ERROR !!") {
                        $cell_items[1] = "2016-12-31 23:59:59.000000";
                    }
                    $insert[] = ['uuid_card' => $cell_items[0], 'time' => $cell_items[1]];

                }


                if (!empty($insert)) {


                    foreach ($insert as $data) {

                        foreach ($uuidlist as $uuid) {


                            if($data['uuid_card'] === $uuid->uuid_name) {

                                DB::table('cross_trail')
                                    ->where('uuid_card', $uuid->uuid_id)
                                    ->update(['start' => "2016-12-31 00:00:00.000000", 'finish' => $data['time'], 'time' => $data['time']]);
                            }

                        }
                    }

                    return redirect('/import-trail-cross')->with('success', 'UUID Cards from file has imported successed.');

                }
            }
        }
        return back();
    }


}