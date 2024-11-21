<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentFotoController;
use App\Http\Controllers\FotoCategoryController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Rute untuk menangani semua tentang AUTHENTICATION ketika belu masuk
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'showFormLogin'])->name('login');
    Route::get('/registration', [AuthenticationController::class, 'showFormRegis'])->name('register');
    Route::post('/login', [AuthenticationController::class, 'doLogin'])->name('do-login');
    Route::post('/registration', [AuthenticationController::class, 'doRegis'])->name('do-registration');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Rute untuk menangani semua tentang AUTHENTICATION ketika sudah masuk
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Rute untuk menangani semua tentang ALBUM
    Route::prefix('album')->name('album.')->group(function () {
        Route::get('/', [AlbumController::class, 'index'])->name('index');
        Route::get('show/{album_name}', [AlbumController::class, 'show'])->name('show');
        Route::get('create', [AlbumController::class, 'create'])->name('create');
        Route::post('store', [AlbumController::class, 'store'])->name('store');
        Route::get('edit', [AlbumController::class, 'edit'])->name('edit');
        Route::post('update', [AlbumController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [AlbumController::class, 'destroy'])->name('destroy');
    });

    // Rute untuk menangani semua tentang FOTO
    Route::prefix('foto')->name('foto.')->group(function () {
        Route::get('{name}', [FotoController::class, 'show'])->name('show');
        Route::get('create', [FotoController::class, 'create'])->name('create');
        Route::post('store', [FotoController::class, 'store'])->name('store');
        Route::get('edit', [FotoController::class, 'edit'])->name('edit');
        Route::post('update', [FotoController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [FotoController::class, 'destroy'])->name('destroy');
    });
    Route::get('liked-foto', [FotoController::class, 'likedFoto'])->name('liked-foto');

    // Rute untuk menangani semua tentang KATEGORI FOTO
    Route::prefix('category-foto')->name('category-foto.')->group(function () {
        Route::get('{name}', [FotoCategoryController::class, 'index'])->name('index');
        Route::get('create', [FotoCategoryController::class, 'create'])->name('create');
        Route::post('store', [FotoCategoryController::class, 'store'])->name('store');
        Route::get('edit', [FotoCategoryController::class, 'edit'])->name('edit');
        Route::post('update', [FotoCategoryController::class, 'update'])->name('update');
        Route::get('destroy', [FotoCategoryController::class, 'destroy'])->name('destroy');
    });

    // Rute untuk menangani semua tentang COMMENT FOTO
    Route::prefix('comment-foto')->name('comment-foto.')->group(function () {
        Route::post('store', [CommentFotoController::class, 'store'])->name('store');
        Route::get('update', [CommentFotoController::class, 'update'])->name('update');
        Route::get('destroy', [CommentFotoController::class, 'destroy'])->name('destroy');
    });
});
