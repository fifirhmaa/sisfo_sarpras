<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\BorrowsController;
use App\Http\Controllers\Api\ReturnsController;

// AUTH API
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/items', [ItemsController::class, 'index']);
    Route::get('/items/{id}', [ItemsController::class, 'show']);
    Route::get('/borrows/{userId}', [BorrowsController::class, 'index']);
    Route::get('/borrow/{userId}/{borrowId}', [BorrowsController::class, 'show']);
    Route::post('/borrows', [BorrowsController::class, 'store']);
    Route::get('/returns', [ReturnsController::class, 'index']);
    Route::post('/returns', [ReturnsController::class, 'store']);
});
