<?php

namespace App\Models;

class Team extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    public $fillable = [
        'team_id',
        'uuid_card',
        'team_name',
        'club_id',
        'category_id',
    ];

}