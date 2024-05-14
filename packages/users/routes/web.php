<?php

use Leo\Users\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::prefix('users')->name('users.')->group(function () {
    Route::resource('/', UserController::class);
});