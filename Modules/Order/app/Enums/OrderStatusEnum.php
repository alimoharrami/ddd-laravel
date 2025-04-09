<?php

namespace Modules\Order\Enums;

class OrderStatusEnum
{
    const PENDING   = 1;
    const PAYED     = 2;

    const STATUS_ALL    = [
        self::PENDING   => 'Pending',
        self::PAYED     => 'Payed',
    ];
}
