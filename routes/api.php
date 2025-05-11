<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\V1\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

// Protected Routes
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('/posts', PostController::class)->only([ 'store','update', 'destroy']);
});
