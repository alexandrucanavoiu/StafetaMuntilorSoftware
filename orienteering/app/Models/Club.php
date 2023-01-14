<?php

namespace App\Models;

class Club extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    public $fillable = [
        'club_id',
        'club_name',
    ];

    public function teams()
    {
        return $this->HasMany('App\Models\Team', 'club_id', 'club_id');
    }

}