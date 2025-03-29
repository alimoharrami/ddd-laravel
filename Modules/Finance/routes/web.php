<?php

use Illuminate\Support\Facades\Route;
use Modules\Finance\Http\Controllers\FinanceController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('finance', FinanceController::class)->names('finance');
});
