<?php

namespace Modules\Cart\Services;

use App\Modules\Product\Domain\Models\Cart;
use App\Shared\Contracts\Product\ProductServiceInterface;

class CartProductService{
    public function attachProductsToCart(Cart $cart, ProductServiceInterface $productService): Cart
    {
        $productIds = $cart->items->pluck('product_id');
        $products = $productService->getProductDTOs($productIds);

        $cart->attachProductsToItems($products);

        return $cart;
    }
}
