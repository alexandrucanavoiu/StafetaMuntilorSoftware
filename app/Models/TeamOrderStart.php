<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TeamOrderStart extends Model

{

    protected $table = 'team_order_start';

    protected $dates = [
        'created_at',
        'updated_at',
        'order_date_start'
    ];

    protected $fillable = [
        'id',
        'order_start_minutes',
    ];

}
