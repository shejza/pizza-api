<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'card_number',
        'card_name',
        'cvv',
        'expiration_date',
        'user_id'
    ];
}
