<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Landing Page Utama
Route::get('/', function () {
    return view('welcome');
});

// Grup Rute Proteksi: User harus LOGIN terlebih dahulu
Route::middleware(['auth'])->group(function () {
    
    // Rute khusus Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
        Route::delete('/admin/user/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.delete-user');
    });

    // Rute khusus Author
    Route::middleware(['role:author'])->group(function () {
        Route::get('/author/dashboard', [DashboardController::class, 'author'])->name('author.dashboard');
    });

    // Rute khusus Reader
    Route::middleware(['role:reader'])->prefix('reader')->name('reader.')->group(function () {
        Route::get('/dashboard', [ReviewController::class, 'index'])->name('dashboard');
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::get('/baca/{id}', [ReviewController::class, 'baca'])->name('baca');

        // Logika Backend untuk simpan rating & ulasan
        Route::post('/review/{naskah_id}', [ReviewController::class, 'storeReview'])->name('review.store');
        Route::post('/summary/{id}', [ReviewController::class, 'summary'])->name('summary');
    });

    // Rute khusus Publisher
    Route::middleware(['role:publisher'])->group(function () {
        Route::get('/publisher/dashboard', [DashboardController::class, 'publisher'])->name('publisher.dashboard');
    });

    // Rute khusus Buyer
    Route::middleware(['role:buyer'])->group(function () {
        Route::get('/buyer/dashboard', [DashboardController::class, 'buyer'])->name('buyer.dashboard');
    });
});

require __DIR__.'/auth.php';