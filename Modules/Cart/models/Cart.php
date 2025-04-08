<?php

namespace App\Modules\Product\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    /**
     * Get the cart items for the cart.
     */
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Attaches products to cartItems.
     */
    public function attachProductsToItems($products): Cart
    {
        $productMap = collect($products)->keyBy('id');

        foreach ($this->items as $item) {
            $item->product = $productMap[$item->product_id] ?? null;
        }

        return $this;
    }
}
