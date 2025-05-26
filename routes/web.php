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


// Login Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.submit'); // Correct POST route for login

// Dashboard Routes (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Kategori Routes
Route::resource('categories', CategoriesController::class);
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');

// Items Routes
Route::resource('items', ItemsController::class);
//Route::get('/items', [ItemsController::class, 'index'])->name('items.barang');


// Registrasi Routes
Route::resource('users', UserController::class);
Route::get('/registrasi', [UserController::class, 'index'])->name('pendaftaran.daftar');
Route::get('/registrasi/create', [UserController::class, 'create'])->name('pendaftaran.create');
//Route::post('/registrasi', [UserController::class, 'store'])->name('pendaftaran.store');
Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');

// Peminjaman Routes
Route::resource('borrows', BorrowController::class);
Route::resource('borrows', BorrowController::class)->only(['index', 'destroy']);
Route::post('borrows/{borrow}/approve', [BorrowController::class, 'approve'])->name('borrows.approve');
Route::post('borrows/{borrow}/reject', [BorrowController::class, 'reject'])->name('borrows.reject');

// Pengembalian Routes
Route::resource('returns', ReturnsController::class)->only(['index', 'destroy']);

// Laporan Routes
Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');
Route::get('/laporan/barang', [ReportController::class, 'dataBarang'])->name('laporan.barang');
Route::get('/laporan/peminjaman', [ReportController::class, 'peminjaman'])->name('laporan.peminjaman');
Route::get('/laporan/pengembalian', [ReportController::class, 'pengembalian'])->name('laporan.pengembalian');
Route::get('/laporan/export/{type}', [ReportController::class, 'exportPdf'])->name('laporan.export');

// Export Routes
Route::get('/items/export/pdf', [ItemsController::class, 'exportPDF'])->name('items.export.pdf');

//Logout Routes
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
