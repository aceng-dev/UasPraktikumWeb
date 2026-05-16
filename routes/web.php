<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Landing Page Utama
Route::get('/', function () {
    return view('welcome');
});

// Grup Rute Proteksi: User harus LOGIN terlebih dahulu
Route::middleware(['auth'])->group(function () {
    
    // Rute khusus Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    });

    // Rute khusus Author
    Route::middleware(['role:author'])->group(function () {
        Route::get('/author/dashboard', [DashboardController::class, 'author'])->name('author.dashboard');
    });

    // Rute khusus Reader
    Route::middleware(['role:reader'])->group(function () {
        Route::get('/reader/dashboard', [DashboardController::class, 'reader'])->name('reader.dashboard');
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