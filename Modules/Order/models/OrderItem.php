<?php

namespace App\Modules\Product\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * Get the order that owns the cart item.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
