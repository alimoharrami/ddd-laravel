<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;
use Modules\User\Http\Controllers\ProfileController;


Route::get('login', [AuthController::class, 'login'])->middleware('throttle:4,1');
Route::post('register', [AuthController::class, 'register'])->middleware('throttle:4,1');

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('profile', [ProfileController::class, 'getProfile']);
    Route::put('profile', [ProfileController::class, 'updateProfile']);
});
