<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Team extends Model

{

    protected $table = 'teams';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'stage_id',
        'number',
        'name',
        'club_id',
        'category_id',
        'chipno',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function club()
    {
        return $this->belongsTo('App\Models\Club', 'club_id');
    }

    public function knowledge()
    {
        return $this->belongsTo('App\Models\Knowledge', 'id', 'team_id' );
    }

    public function climb()
    {
        return $this->belongsTo('App\Models\Climb', 'id', 'team_id');
    }    

    public function orienteering()
    {
        return $this->belongsTo('App\Models\Orienteering', 'id', 'team_id' );
    }

    public function  raidmontan_participations()
    {
        return $this->belongsTo('App\Models\RaidmontanParticipations', 'id', 'team_id' );
    }

    public function  raidmontan_participations_entries()
    {
        return $this->hasMany('App\Models\RaidmontanParticipationsEntries', 'team_id', 'id' );
    }

    public function participants()
    {
        return $this->hasMany('App\Models\ParticipantsStages', 'team_id', 'id' );
    }

}
