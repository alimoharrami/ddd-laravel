<?php

use Illuminate\Support\Facades\Route;
use Modules\Finance\Http\Controllers\WalletController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('finance', WalletController::class)->names('finance');
});
