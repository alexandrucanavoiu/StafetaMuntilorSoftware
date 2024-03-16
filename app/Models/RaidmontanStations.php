<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RaidmontanStations extends Model

{

    protected $table = 'raidmontan_stations';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'stage_id',
        'category_id',
        'station_type',
        'maximum_time',
        'points'
    ];

}
