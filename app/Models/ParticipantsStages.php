<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ParticipantsStages extends Model

{

    protected $table = 'participants_stages';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'stage_id',
        'participant_id',
        'team_id',
    ];

    public function participants()
    {
        return $this->hasMany('App\Models\Participants', 'id', 'participant_id' );
    }

    public function create($data)
    {
        $this->insert($data);
    }

    public function team()
    {
        return $this->belongsTo('App\Models\ParticipantsStageRankings', 'team_id', 'team_id');
    }

}
