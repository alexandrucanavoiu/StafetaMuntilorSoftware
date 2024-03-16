<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Club extends Model

{

    protected $table = 'clubs';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'stage_id',
        'name',
    ];

    public function cultural()
    {
        return $this->belongsTo('App\Models\Cultural', 'id', 'club_id');
    }

    public function teams()
    {
        return $this->hasMany('App\Models\Team');
    }

}
