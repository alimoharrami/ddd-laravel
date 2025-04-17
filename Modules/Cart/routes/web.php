<?php

use Illuminate\Support\Facades\Route;
use Modules\Cart\Http\Controllers\CartController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('cart', CartController::class)->names('cart');
});
