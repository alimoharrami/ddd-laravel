<?php

namespace App\Modules\Product\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'total_price',
        'shipping_address'
    ];

    //todo order product

    //todo order enum
}
