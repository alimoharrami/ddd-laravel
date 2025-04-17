<?php
namespace Modules\Shared\DTOs\Finance;

class TransactionDTO
{
    public int $id;
    public ?int $order_id;
    public float $amount;
    public string $type;
    public string $status;


    /**
     * TransactionDTO constructor.
     *
     * @param int $id
     * @param int|null $order_id
     * @param float $amount
     * @param string $type
     * @param string $status
     */
    public function __construct(int $id, ?int $order_id, float $amount, string $type, string $status)
    {
        $this->id = $id;
        $this->order_id = $order_id;
        $this->amount = $amount;
        $this->type = $type;
        $this->status = $status;
    }
}
