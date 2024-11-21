<?php

use App\Http\Controllers\FotoLikeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('guest')->group(function () {
    // API LIKE
    // Rute untuk menangani semua tentang LIKE FOTO
    Route::prefix('like-foto')->name('like-foto.')->group(function () {
        Route::post('store', [FotoLikeController::class, 'store'])->name('store');
        Route::post('destroy', [FotoLikeController::class, 'destroy'])->name('destroy');
    });
});
