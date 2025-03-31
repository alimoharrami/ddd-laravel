<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Domain\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categories = ProductCategory::all();

        return response()->json([
            'product_categories' => $categories
        ]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id): JsonResponse
    {
        $category = ProductCategory::query()->find($id);

        if (!$category) {
            return response()->json(['message' => 'Product category not found'], ResponseAlias::HTTP_NOT_FOUND);
        }

        return response()->json([
            'product_category' => $category
        ]);
    }
}
