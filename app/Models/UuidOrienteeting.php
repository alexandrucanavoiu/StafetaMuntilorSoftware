<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UuidOrienteeting extends Model

{

    protected $table = 'uuids_orienteering';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'name',
    ];

}
