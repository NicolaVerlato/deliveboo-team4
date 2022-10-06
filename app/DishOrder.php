<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishOrder extends Model
{
    protected $table = 'dish_order';
    protected $fillable = [
        'order_id',
        'dish_id'
    ];
}
