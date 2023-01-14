<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Cultural extends Model

{

    protected $table = 'cultural';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'club_id',
        'scor'
    ];

}
