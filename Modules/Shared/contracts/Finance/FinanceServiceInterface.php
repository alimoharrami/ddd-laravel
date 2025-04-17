<?php

namespace App\Shared\Contracts\User;

use Modules\Shared\DTOs\Finance\TransactionDTO;

interface FinanceServiceInterface
{
    /**
     * get Transaction DTOs with order id
     *
     * @param int $orderID orderID
     * @return TransactionDTO[]
 */
    public function getTransactionDTOsWithOrderID(int $orderID): array;
}
