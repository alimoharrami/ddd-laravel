<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Domain\Models\Product;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     */
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * Show the specified product.
     */
    public function show($id): JsonResponse
    {
        $product = Product::query()->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], ResponseAlias::HTTP_NOT_FOUND);
        }

        return response()->json([
            'product' => $product
        ]);
    }
}
