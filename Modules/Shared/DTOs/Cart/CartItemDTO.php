<?php
namespace Modules\Shared\DTOs\User;

class CartItemDTO
{
    public int $id;
    public int $product_id;
    public int $quantity;
    public float $price;


    /**
     * CartDTO constructor.
     *
     * @param int $id
     * @param int $product_id
     * @param int $quantity
     * @param float $price
     */
    public function __construct(int $id, int $product_id, int $quantity, float $price)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->price = $price;
    }
}
