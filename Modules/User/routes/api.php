<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\ProfileController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('user', ProfileController::class)->names('user');
});
