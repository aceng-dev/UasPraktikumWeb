<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Landing Page Utama
Route::get('/', function () {
    return view('welcome');
});

// Grup Rute Proteksi: User harus LOGIN terlebih dahulu
Route::middleware(['auth'])->group(function () {

    // ── ADMIN ────────────────────────────────────────────────
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
        Route::delete('/admin/user/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.delete-user');
    });

    // ── AUTHOR ───────────────────────────────────────────────
    Route::middleware(['role:author'])->prefix('author')->name('author.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AuthorController::class, 'index'])->name('dashboard');

        // CRUD Buku
        Route::get('/buku/tambah',      [AuthorController::class, 'create'])->name('buku.create');
        Route::post('/buku',            [AuthorController::class, 'store'])->name('buku.store');
        Route::get('/buku/{id}/edit',   [AuthorController::class, 'edit'])->name('buku.edit');
        Route::put('/buku/{id}',        [AuthorController::class, 'update'])->name('buku.update');
        Route::delete('/buku/{id}',     [AuthorController::class, 'destroy'])->name('buku.destroy');
    });

    // ── READER ───────────────────────────────────────────────
    Route::middleware(['role:reader'])->prefix('reader')->name('reader.')->group(function () {
        Route::get('/dashboard',            [ReviewController::class, 'index'])->name('dashboard');
        Route::get('/',                     [ReviewController::class, 'index'])->name('index');
        Route::get('/baca/{id}',            [ReviewController::class, 'baca'])->name('baca');
        Route::get('/koleksi',              [ReviewController::class, 'koleksi'])->name('koleksi');
        Route::get('/favorit',              [ReviewController::class, 'favorit'])->name('favorit');
        Route::get('/bookmark',             [ReviewController::class, 'bookmark'])->name('bookmark');
        Route::post('/review/{naskah_id}',  [ReviewController::class, 'storeReview'])->name('review.store');
        Route::post('/summary/{id}',        [ReviewController::class, 'summary'])->name('summary');
    });

    // ── PUBLISHER ────────────────────────────────────────────
    Route::middleware(['role:publisher'])->group(function () {
        Route::get('/publisher/dashboard', [DashboardController::class, 'publisher'])->name('publisher.dashboard');
    });

    // ── BUYER ────────────────────────────────────────────────
    Route::middleware(['role:buyer'])->group(function () {
        Route::get('/buyer/dashboard', [DashboardController::class, 'buyer'])->name('buyer.dashboard');
    });
});

require __DIR__.'/auth.php';