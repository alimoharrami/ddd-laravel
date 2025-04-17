<?php

namespace Modules\Finance\Services;

use App\Modules\Product\Domain\Models\Transaction;
use Modules\Finance\Enums\TransactionStatusEnum;
use Modules\Finance\Enums\TransactionTypeEnum;

class PaymentService{
    public function processPayment(float $amount, ?int $order_id = null): ?int
    {
        $transaction = new Transaction();

        $transaction->amount = $amount;
        $transaction->type = TransactionTypeEnum::ORDER_CHECKOUT;
        $transaction->status = TransactionStatusEnum::COMPLETED;
        $transaction->order_id = $order_id;
        $transaction->save();

        return $transaction->id;
    }
}
