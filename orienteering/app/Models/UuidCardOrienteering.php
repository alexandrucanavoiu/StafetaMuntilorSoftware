<?php

namespace App\Models;

class UuidCardOrienteering extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'uuids';

    public $fillable = [
        'uuid_id',
        'uuid_name',
    ];

}