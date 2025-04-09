<?php

namespace Modules\Finance\Shared;

use App\Modules\Product\Domain\Models\Transaction;
use App\Shared\Contracts\User\FinanceServiceInterface;
use Modules\Shared\DTOs\Finance\TransactionDTO;

class FinanceService implements FinanceServiceInterface
{
    public function getTransactionDTOsWithOrderID(int $orderID): array
    {
       $transactions = Transaction::query()->where('order_id', $orderID)->get();

        return $transactions->map(function ($transaction) {
            return new TransactionDTO(
                id : $transaction->id,
                order_id : $transaction->order_id,
                amount : $transaction->amount,
                type : $transaction->status_name,
                status: $transaction->status,
            );
        })->toArray();
    }
}


