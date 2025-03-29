<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Http\Controllers\SharedController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('shared', SharedController::class)->names('shared');
});
