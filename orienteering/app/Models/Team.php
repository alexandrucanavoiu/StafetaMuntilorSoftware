<?php

namespace App\Models;

class Team extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $dates = ['updated_at'];

    public $fillable = [
        'team_id',
        'uuid_card',
        'team_name',
        'club_id',
        'category_id',
    ];

    public function club()
    {
        return $this->belongsTo('App\Models\Club', 'club_id', 'club_id');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'category_id', 'category_id');
    }
}