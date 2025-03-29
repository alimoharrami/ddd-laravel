<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\ProfileController;

//Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('user', ProfileController::class)->names('user');
//});
