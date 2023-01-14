<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UuidRaid extends Model

{

    protected $table = 'uuids_raid';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'name',
    ];

}
