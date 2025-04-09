<?php

namespace App\Shared\Contracts\User;

use Modules\Shared\DTOs\User\CartItemDTO;

interface OrderServiceInterface
{
    /**
     * submit order with products in cart
     *
     * @param CartItemDTO[] $cart_items // Array of CartItemDTO objects
     * @param int $user_id
     * @return void
     */
    public function submitOrder(int $user_id, array $cart_items): void;

    /**
     * order payed change status
     *
     * @param int $order_id
     * @return void
     */
    public function orderPayed(int $order_id): void;

    /**
     * get total order amount with order id
     *
     * @param int $order_id
     * @return float
     */
    public function getOrderAmountWithOrderId(int $order_id): float;
}
