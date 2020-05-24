<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails';
    protected $fillable = [
        'quantity',
        'price_order',
        'pizza_id',
        'order_id',
        'payment_id'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function pizza()
    {
        return $this->belongsTo('App\Pizza', 'pizza_id');
    }

      public function payment()
    {
        return $this->belongsTo('App\Payment', 'payment_id');
    }

    
}
