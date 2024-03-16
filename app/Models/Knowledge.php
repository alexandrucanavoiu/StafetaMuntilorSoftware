<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Knowledge extends Model

{

    protected $table = 'knowledges';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'stage_id',
        'team_id',
        'wrong_answers',
        'time',
        'abandon',
        'wrong_questions'
    ];

}
