<?php

namespace Modules\Finance\Enums;

class TransactionTypeEnum
{
    const ORDER_CHECKOUT  = 1;

    const STATUS_ALL    = [
        self::ORDER_CHECKOUT  => 'Order Checkout',
    ];
}
