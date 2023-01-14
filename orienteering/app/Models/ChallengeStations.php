<?php

namespace App\Models;

class ChallengeStations extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'challenge_stations';

    public $fillable = [
        'station_id',
        'category_challenge_id',
        'station_type',
        'maximum_time',
        'score',
    ];

}