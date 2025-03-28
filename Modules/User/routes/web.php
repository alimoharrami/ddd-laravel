<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

//Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('user', UserController::class)->names('user');
//});
