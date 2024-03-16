<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Stages extends Model

{

    protected $table = 'stages';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'name',
        'ong',
    ];

}
