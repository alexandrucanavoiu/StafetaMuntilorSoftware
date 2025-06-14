<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Climb extends Model

{

    protected $table = 'climbs';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'stage_id',
        'team_id',
        'meters',
        'time',
        'abandon',
    ];

}
