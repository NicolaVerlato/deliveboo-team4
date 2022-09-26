<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'restaurant_id',
        'customer_address',
        'customer_name',
        'customer_email',
        'order_total'
    ];
}
