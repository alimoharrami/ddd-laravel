<?php
namespace Modules\Shared\DTOs\Product;

class ProductDTO
{
    public int $id;
    public string $name;
    public string $description;
    public string $price;

    /**
     * ProductDTO constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $description
     * @param float $price
     */
    public function __construct(int $id, string $name, string $description, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }
}
