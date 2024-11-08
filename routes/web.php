<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentFotoController;
use App\Http\Controllers\FotoCategoryController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\FotoLikeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Rute untuk menangani semua tentang AUTHENTICATION ketika belu masuk
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticationController::class, 'showFormLogin'])->name('login');
    Route::get('/registration', [AuthenticationController::class, 'showFormRegis'])->name('register');
    Route::post('/login', [AuthenticationController::class, 'doLogin'])->name('do-login');
    Route::post('/registration', [AuthenticationController::class, 'doRegis'])->name('do-registration');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Rute untuk menangani semua tentang AUTHENTICATION ketika sudah masuk
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('/', function () {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return view('pages.home.index');
    })->name('home');

    // Rute untuk menangani semua tentang ALBUM
    Route::prefix('album')->name('album.')->group(function () {
        Route::get('/', [AlbumController::class, 'index'])->name('index');
        Route::get('create', [AlbumController::class, 'create'])->name('create');
        Route::post('store', [AlbumController::class, 'store'])->name('store');
        Route::get('edit', [AlbumController::class, 'edit'])->name('edit');
        Route::post('update', [AlbumController::class, 'update'])->name('update');
        Route::get('destroy', [AlbumController::class, 'destroy'])->name('destroy');
    });

    // Rute untuk menangani semua tentang FOTO
    Route::prefix('foto')->name('foto.')->group(function () {
        Route::get('{name}', [FotoController::class, 'show'])->name('show');
        Route::get('create', [FotoController::class, 'create'])->name('create');
        Route::post('store', [FotoController::class, 'store'])->name('store');
        Route::get('edit', [FotoController::class, 'edit'])->name('edit');
        Route::post('update', [FotoController::class, 'update'])->name('update');
        Route::get('destroy', [FotoController::class, 'destroy'])->name('destroy');
    });

    // Rute untuk menangani semua tentang KATEGORI FOTO
    Route::prefix('category-foto')->name('category-foto.')->group(function () {
        Route::get('create', [FotoCategoryController::class, 'create'])->name('create');
        Route::post('store', [FotoCategoryController::class, 'store'])->name('store');
        Route::get('edit', [FotoCategoryController::class, 'edit'])->name('edit');
        Route::post('update', [FotoCategoryController::class, 'update'])->name('update');
        Route::get('destroy', [FotoCategoryController::class, 'destroy'])->name('destroy');
    });

    // Rute untuk menangani semua tentang COMMENT FOTO
    Route::prefix('comment-foto')->name('comment-foto.')->group(function () {
        Route::get('store', [CommentFotoController::class, 'store'])->name('store');
        Route::get('update', [CommentFotoController::class, 'update'])->name('update');
        Route::get('destroy', [CommentFotoController::class, 'destroy'])->name('destroy');
    });

    // Rute untuk menangani semua tentang LIKE FOTO
    Route::prefix('like-foto')->name('like-foto.')->group(function () {
        Route::get('store', [FotoLikeController::class, 'store'])->name('store');
        Route::get('destroy', [FotoLikeController::class, 'destroy'])->name('destroy');
    });
});
