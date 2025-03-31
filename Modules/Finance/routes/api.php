<?php

use Illuminate\Support\Facades\Route;
use Modules\Finance\Http\Controllers\TransactionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::post('pay', [TransactionController::class, 'pay'])->name('pay');
});
