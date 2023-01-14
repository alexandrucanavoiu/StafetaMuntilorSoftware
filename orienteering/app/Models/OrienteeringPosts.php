<?php

namespace App\Models;

class OrienteeringPosts extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'orienteering_stages';

    public $fillable = [
        'id',
        'orienteering_id',
        'post',
    ];

}