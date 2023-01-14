<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model

{

    protected $table = 'categories';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'name',
        'order_start',
    ];

}
