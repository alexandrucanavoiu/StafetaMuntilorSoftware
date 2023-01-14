<?php

namespace App\Models;

class Orienteering extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'orienteering';

    public $fillable = [
        'orienteering_id',
        'team_id',
        'uuid_card',
        'name_participant',
        'start',
        'finish',
        'total',
        'abandon',
        'missed_posts',
    ];

}