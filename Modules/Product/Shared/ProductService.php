<?php

namespace Modules\Product\Shared;

use App\Modules\Product\Domain\Models\Product;
use App\Shared\Contracts\Product\ProductServiceInterface;
use Modules\Shared\DTOs\Product\ProductDTO;

class ProductService implements ProductServiceInterface
{
    public function getProductDTO(int $productId): ?productDTO
    {
        $product = Product::query()->find($productId);

        if(!$product) return null;

        return new ProductDTO(
            id: $product->id,
            name: $product->name,
            description: $product->description,
            price: $product->price,
        );
    }

    public function getProductDTOs(array $productIds): array
    {
        $products = Product::query()->whereIn('id', $productIds)->get();

        return $products->map(function ($product) {
            return new ProductDTO(
                id: $product->id,
                name: $product->name,
                description: $product->description,
                price: $product->price,
            );
        })->toArray();
    }

    public function getProductDTOAvailable(int $productId, int $quantity): ?productDTO
    {
        $product = Product::query()->find($productId);

        if(!$product) return null;

        if($product->stock < $quantity) return null;

        return new ProductDTO(
            id: $product->id,
            name: $product->name,
            description: $product->description,
            price: $product->price,
        );
    }
}


