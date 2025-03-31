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
     * get order id from transaction id
     *
     * @param int $transaction_id
     * @return int
     */
    public function getOrderIdByTransactionId(int $transaction_id): int;

    /**
     * order payed change status
     *
     * @param int $order_id
     * @param int $transaction_id
     * @return void
     */
    public function orderPayed(int $order_id, int $transaction_id): void;

    /**
     * get total order amount with order id
     *
     * @param int $order_id
     * @return float
     */
    public function getOrderAmountWithOrderId(int $order_id): float;
}
