<?php

namespace App\Models;

class Category extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    public $fillable = [
        'category_id',
        'category_name',
        'position',
        'order_start',
    ];


}