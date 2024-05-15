<?php

use Illuminate\Support\Facades\Route;
use Leo\Scores\Controllers\ScoreController;
use App\Http\Middleware\JWT;
use Leo\Users\Controllers\UserController;

Route::prefix('api/scores')->name('api.scores.')->group(function () {
    Route::get('/', [ScoreController::class, 'index'])->name('index');
    Route::get('/create', [ScoreController::class, 'create'])->name('create');
    Route::post('/', [ScoreController::class, 'store'])->name('store');
    Route::get('/export', [ScoreController::class, 'export'])->name('export');
    Route::post('/export', [ScoreController::class, 'export_mail'])->name('export_mail');
    Route::get('/users',[UserController::class,'get_scores'])->middleware(JWT::class)->name('users.score');
});
