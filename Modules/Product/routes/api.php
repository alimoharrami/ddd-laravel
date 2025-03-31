<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductCategoryController;
use Modules\Product\Http\Controllers\ProductController;

Route::get('product', [ProductController::class, 'index']);
Route::get('product/{id}', [ProductController::class, 'show']);

Route::get('product-category', [ProductCategoryController::class, 'index']);
Route::get('product-category/{id}', [ProductCategoryController::class, 'show']);
