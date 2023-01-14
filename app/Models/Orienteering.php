<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Orienteering extends Model

{

    protected $table = 'orienteering';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'team_id',
        'start_time',
        'finish_time',
        'total_time',
        'abandon',
        'missed_posts',
        'order_posts',
    ];

}
