<?php

use Leo\Users\Controllers\UserController;

use Illuminate\Support\Facades\Route;


Route::prefix('api/users')->name('api.users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::post('/checkLogin', [UserController::class, 'store'])->name('checkLogin');
    Route::post('/checkLogin-social', [UserController::class, 'store'])->name('checkLoginSocial');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
});