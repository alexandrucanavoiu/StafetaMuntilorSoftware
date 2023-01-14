<?php

namespace App\Models;

class UuidCardTrail extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'uuid_trail';

    public $fillable = [
        'uuid_id',
        'uuid_name',
    ];

}