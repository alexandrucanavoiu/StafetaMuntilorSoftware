<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ParticipantsStageRankings extends Model

{

    protected $table = 'participants_stage_rankings';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'stage_id',
        'club_id',
        'team_id',
        'category_id',
        'category_name',
        'scor'
    ];

    public function create($data)
    {
        $this->insert($data);
    }

}
