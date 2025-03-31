<?php

class TransactionStatusEnum
{
    const PENDING   = 1;
    const COMPLETED = 2;
    const FAILED    = 3;
    CONST CANCELLED = 4;

    const STATUS_ALL    = [
        self::PENDING       => 'Pending',
        self::COMPLETED     => 'Completed',
        self::FAILED        => 'Failed',
        self::CANCELLED     => 'Cancelled',
    ];
}
