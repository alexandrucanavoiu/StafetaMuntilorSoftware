<?php

namespace App\Models;

class ChallengeStationsStages extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'challenge_stations_stages';

    public $fillable = [
        'id',
        'category_id',
        'post',
        'time',
    ];

}