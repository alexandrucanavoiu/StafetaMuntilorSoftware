<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RaidmontanParticipations extends Model

{

    protected $table = 'raidmontan_participations';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'stage_id',
        'team_id',
        'missing_equipment_items',
        'missing_footwear',
        'abandon',
        'minimum_distance_penalty'
    ];

    public function RaidmontanStations()
    {
        return $this->belongsTo('App\Models\RaidmontanStations', 'category_id', 'category_id');
    }

}
