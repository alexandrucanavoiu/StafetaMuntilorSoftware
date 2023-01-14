<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrienteeringStationsStages  extends Model

{

    protected $table = 'orienteering_stations_stages';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'category_id',
        'post',
    ];

}
