<?php

use Illuminate\Support\Facades\Route;
use Modules\Shared\Http\Controllers\SharedController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('shared', SharedController::class)->names('shared');
});
