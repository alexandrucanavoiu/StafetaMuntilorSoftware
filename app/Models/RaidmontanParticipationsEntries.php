<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RaidmontanParticipationsEntries extends Model

{

    protected $table = 'raidmontan_participations_entries';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'team_id',
        'raidmontan_participations_id',
        'raidmontan_stations_id',
        'raidmontan_stations_station_type',
        'raidmontan_stations_stages_id',
        'time_start',
        'time_finish',
        'hits'
    ];

    public function RaidmontanStations()
    {
        return $this->hasMany('App\Models\RaidmontanStations', 'id', 'raidmontan_stations_id');
    }

}
