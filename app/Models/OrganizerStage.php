<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrganizerStage extends Model

{

    protected $table = 'organizer_stages';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'software'
    ];

}
