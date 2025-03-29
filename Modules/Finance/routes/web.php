<?php

use Illuminate\Support\Facades\Route;
use Modules\Finance\Http\Controllers\WalletController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('finance', WalletController::class)->names('finance');
});
