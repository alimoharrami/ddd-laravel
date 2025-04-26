<?php

namespace Modules\Order\Shared;

use App\Modules\Product\Domain\Models\Order;
use App\Modules\Product\Domain\Models\OrderItem;
use App\Shared\Contracts\Product\ProductServiceInterface;
use App\Shared\Contracts\User\OrderServiceInterface;
use App\Shared\Contracts\User\UserServiceInterface;
use Modules\Order\Enums\OrderStatusEnum;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        private readonly UserServiceInterface $userService,
        private readonly ProductServiceInterface $productService,
    )
    {
        //
    }

    public function submitOrder(int $user_id, array $cart_items): void
    {
        $userService = $this->userService;
        $productService = $this->productService;

        DB::transaction(function () use ($user_id, $cart_items, $productService, $userService) {

            $userAddress = $userService->getUserAddressDTO($user_id);

            $order = Order::query()->create([
                'user_id' => $user_id,
                'status' => OrderStatusEnum::PENDING,
                'shipping_address' => $userAddress->address,
            ]);
            $priceSum = 0;
            foreach ($cart_items as $item) {
                OrderItem::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
                $priceSum += $item['price'] * $item['quantity'];

                $productService->reduceStock($item['product_id'], $item['quantity']);
            }
            $order->update(['total_price' => $priceSum]);
        });
    }
    public function orderPayed(int $order_id): void
    {
        $order = Order::query()->findOrFail($order_id);
        $order->update(['status' => OrderStatusEnum::PAYED]);
    }

    public function getOrderAmountWithOrderId(int $order_id): float
    {
        $order = Order::query()->findOrFail($order_id);
        return $order->total_price;
    }
}


