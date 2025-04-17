<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\OrderController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('/orders', [OrderController::class, 'index']);
});
