<?php

namespace Modules\Finance\Http\Services;

use App\Modules\Product\Domain\Models\Transaction;
use TransactionStatusEnum;
use TransactionTypeEnum;

class PaymentService{
    public function processPayment(float $amount): ?int
    {
        $transaction = new Transaction();

        $transaction->amount = $amount;
        $transaction->type = TransactionTypeEnum::ORDER_CHECKOUT;
        $transaction->status = TransactionStatusEnum::COMPLETED;
        $transaction->save();

        return $transaction->id;
    }
}
