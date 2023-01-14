<?php

namespace App\Models;

class OrderStart extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'order_start';

    protected $dates = ['date_start', 'updated_at'];

    public $fillable = [
        'id',
        'category_name',
        'date_start',
        'minutes',
    ];


}