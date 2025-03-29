<?php

namespace App\Shared\Contracts\Product;

use Modules\Shared\DTOs\Product\ProductDTO;

interface ProductServiceInterface
{
    /**
     * get product dto with product id
     *
     * @param int $productId
     * @return ProductDTO|null
     */
    public function getProductDTO(int $productId): ?productDTO;

    /**
     * get many product DTOs
     *
     * @param array $productIds
     * @return array
     */
    public function getProductDTOs(array $productIds): array;
}
