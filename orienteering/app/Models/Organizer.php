<?php

namespace App\Models;

class Organizer extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'organizer';

    public $fillable = [
        'id_organizer',
        'name_trophy',
        'name_organizer',
    ];
}