<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RaidmontanStationsStages  extends Model

{

    protected $table = 'raidmontan_stations_stages';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'stage_id',
        'category_id',
        'post',
        'cod_start',
        'cod_finish',
        'time'
    ];

}
