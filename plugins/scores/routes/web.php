<?php
use Illuminate\Support\Facades\Route;
use Leo\Scores\Controllers\ScoreController;

Route::prefix('api/scores')->name('api.scores.')->group(function () {
    Route::get('/', [ScoreController::class, 'index'])->name('index');
    Route::get('/create', [ScoreController::class, 'create'])->name('create');
    Route::post('/', [ScoreController::class, 'store'])->name('store');
    Route::get('/{user}', [ScoreController::class, 'show'])->name('show');
});