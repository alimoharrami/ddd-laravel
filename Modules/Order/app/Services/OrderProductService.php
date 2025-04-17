<?php

namespace Modules\Order\Services;

use App\Modules\Product\Domain\Models\Order;
use App\Shared\Contracts\Product\ProductServiceInterface;
use Illuminate\Support\Collection;

class OrderProductService{
    public function attachProductsToOrders($orders, ProductServiceInterface $productService): Collection
    {
        $orders->each(function ($order) use ($productService) {
            $this->attachProductsToOrder($order, $productService);
        });

        return $orders;
    }

    public function attachProductsToOrder(Order $order, ProductServiceInterface $productService): Order
    {
        $productIds = $order->items->pluck('product_id');
        $products = $productService->getProductDTOs($productIds);

        $order->attachProductsToItems($products);

        return $order;
    }
}
