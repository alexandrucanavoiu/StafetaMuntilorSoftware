<?php

namespace App\Models;

class UuidCardRaidMontan extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'uuids_raid';

    public $fillable = [
        'uuid_id',
        'uuid_name',
    ];

}