<?php

namespace App\Modules\Product\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\Enums\OrderStatusEnum;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'total_price',
        'shipping_address'
    ];

    protected $appends = [
        'status_name',
    ];

    public function getStatusNameAttribute(): ?string
    {
        return OrderStatusEnum::STATUS_ALL[$this->status] ?? null;
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function attachProductsToItems($products): Order
    {
        $productMap = collect($products)->keyBy('id');

        foreach ($this->items as $item) {
            $item->product = $productMap[$item->product_id] ?? null;
        }

        return $this;
    }
}
