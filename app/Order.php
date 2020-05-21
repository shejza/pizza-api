<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'order_date',
        'user_id',
        'address',
        'contact'
    ];

  
}
