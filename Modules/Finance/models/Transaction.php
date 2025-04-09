<?php

namespace App\Modules\Product\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use TransactionStatusEnum;
use TransactionTypeEnum;

class Transaction extends Model
{
    protected $fillable = [
        'wallet_id',
        'user_id',
        'order_id',
        'amount',
        'type',
        'status',
    ];

    protected $appends = [
        'type_name',
        'status_name',
    ];

    public function getTypeNameAttribute(): ?string
    {
        return TransactionTypeEnum::STATUS_ALL[$this->type] ?? null;
    }

    public function getStatusNameAttribute(): ?string
    {
        return TransactionStatusEnum::STATUS_ALL[$this->status] ?? null;
    }
}
