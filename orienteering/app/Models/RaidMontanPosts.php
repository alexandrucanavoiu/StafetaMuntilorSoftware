<?php

namespace App\Models;

class RaidMontanPosts extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'challenge_stations_stages';

    public $fillable = [
        'id',
        'categories_id',
        'post',
        'time',
    ];

}