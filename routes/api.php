<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BorrowController;
use App\Http\Controllers\Api\ReturnsController;
use App\Http\Controllers\Api\ReportController;

// AUTH API
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// DASHBOARD API (protected)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

// CATEGORIES API (CRUD)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', CategoriesController::class);
});

// ITEMS API (CRUD + export PDF)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('items', ItemsController::class);
    Route::get('/items/export/pdf', [ItemsController::class, 'exportPDF']);
});

// USERS API (registrasi)
Route::post('/register', [UserController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class)->except(['store']);
});

// BORROWS API (CRUD + approve/reject)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('borrows', BorrowController::class);
    Route::post('borrows/{borrow}/approve', [BorrowController::class, 'approve']);
    Route::post('borrows/{borrow}/reject', [BorrowController::class, 'reject']);
});

// RETURNS API (only index and destroy)
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('returns', ReturnsController::class)->only(['index', 'destroy']);
});

// REPORTS API
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/laporan', [ReportController::class, 'index']);
    Route::get('/laporan/barang', [ReportController::class, 'dataBarang']);
    Route::get('/laporan/peminjaman', [ReportController::class, 'peminjaman']);
    Route::get('/laporan/pengembalian', [ReportController::class, 'pengembalian']);
    Route::get('/laporan/export/{type}', [ReportController::class, 'exportPdf']);
});
