<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ReturnsController;
use App\Http\Controllers\ReportController;

// ===================
// LOGIN ROUTES
// ===================
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===================
// PROTECTED ROUTES (AUTH ONLY)
// ===================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories (Kategori)
    Route::resource('categories', CategoriesController::class);

    // Items (Barang)
    Route::resource('items', ItemsController::class);
    Route::get('/items/export/pdf', [ItemsController::class, 'exportPDF'])->name('items.export.pdf');

    // Users (Pendaftaran)
    Route::resource('users', UserController::class);

    // Optional alias route for custom URL '/registrasi'
    Route::get('/registrasi', [UserController::class, 'index'])->name('pendaftaran.daftar');
    Route::get('/registrasi/create', [UserController::class, 'create'])->name('pendaftaran.create');

    // Peminjaman
    Route::resource('borrows', BorrowController::class)->only(['index', 'store', 'create', 'show', 'destroy']);
    Route::post('borrows/{borrow}/approve', [BorrowController::class, 'approve'])->name('borrows.approve');
    Route::post('borrows/{borrow}/reject', [BorrowController::class, 'reject'])->name('borrows.reject');

    // Pengembalian
    Route::resource('returns', ReturnsController::class)->only(['index', 'destroy']);

    // Laporan
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/barang', [ReportController::class, 'dataBarang'])->name('laporan.barang');
    Route::get('/laporan/peminjaman', [ReportController::class, 'peminjaman'])->name('laporan.peminjaman');
    Route::get('/laporan/pengembalian', [ReportController::class, 'pengembalian'])->name('laporan.pengembalian');
    Route::get('/laporan/export/{type}', [ReportController::class, 'exportPdf'])->name('laporan.export');
});
