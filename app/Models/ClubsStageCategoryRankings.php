<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClubsStageCategoryRankings extends Model

{

    protected $table = 'clubs_stage_category_rankings';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'stage_id',
        'category_id',
        'club_id',
        'scor',
    ];

    public function club()
    {
        return $this->belongsTo('App\Models\Club', 'club_id');
    }

    public function create($data)
    {
        $this->insert($data);
    }

}
