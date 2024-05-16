<?php

use Leo\Users\Controllers\UserController;

use Illuminate\Support\Facades\Route;


Route::prefix('api/users')->name('api.users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/export', [UserController::class, 'store'])->name('export.url');
    Route::post('/export', [UserController::class, 'store'])->name('export.mail');
    Route::post('/checkLogin', [UserController::class, 'checkLogin'])->name('checkLogin');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
});