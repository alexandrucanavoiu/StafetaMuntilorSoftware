<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Participants extends Model

{

    protected $table = 'participants';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'ci',
        'phone',
        'name',
        'ong',
    ];


    public function stages()
    {
        return $this->hasMany('App\Models\ParticipantsStages', 'participant_id', 'id');
    }
    


}
