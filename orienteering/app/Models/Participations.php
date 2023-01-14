<?php

namespace App\Models;

class Participations extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'participations';

    public $fillable = [
        'participation_id',
        'team_id',
        'category_challenge_id',
        'score',
        'notes',
        'missing_equipment_items',
        'missing_footwear',
        'abandonment',
        'minimum_distance_penalty',
        'created_at',
        'updated_at',
    ];


}