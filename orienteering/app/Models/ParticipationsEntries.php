<?php

namespace App\Models;



class ParticipationsEntries extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'participation_entries';

    public $fillable = [
        'entry_id',
        'participation_id',
        'station_id',
        'participant_name',
        'time_start',
        'time_finish',
        'hits',
        'post',
        'uuid_id',
    ];

}