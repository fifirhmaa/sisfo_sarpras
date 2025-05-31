<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\BorrowsController;
use App\Http\Controllers\Api\ReturnsController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ReportBorrowController;

// AUTH API
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/items', [ItemsController::class, 'index']);
    Route::get('/items/count', [ItemsController::class, 'itemCount']);
    Route::get('/items/{id}', [ItemsController::class, 'show']);
    Route::get('/items/category/{categoryId}', [ItemsController::class, 'byCategory']);
    Route::get('/borrows/{userId}', [BorrowsController::class, 'index']);
    Route::get('/borrow/{userId}/{borrowId}', [BorrowsController::class, 'show']);
    Route::post('/borrows', [BorrowsController::class, 'store']);
    Route::get('/borrows/count/{userId}', [BorrowsController::class, 'borrowCount']);
    Route::get('/borrows/fine/{userId}', [BorrowsController::class, 'fineCount']);
    Route::post('/reports/borrows', [ReportBorrowController::class, 'generateBorrowReport']);
    Route::get('/returns/{userId}', [ReturnsController::class, 'index']);
    Route::get('/return/{userId}/{returnId}', [ReturnsController::class, 'show']);
    Route::post('/returns', [ReturnsController::class, 'store']);
    Route::get('/returns/count/{userId}', [ReturnsController::class, 'returnCount']);
});
