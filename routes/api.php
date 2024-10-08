<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
	Route::post('register', 'register');
	Route::post('login', 'login');
});




Route::middleware('auth:sanctum')->group(function () {
	Route::get('/me', [AuthController::class, 'me']);
	Route::post('/users', [UserController::class, 'store']);
	Route::get('/users/{id}', [UserController::class, 'showEmployee']);
	Route::post('/posts', [PostController::class, 'store']);
	Route::put('/posts/{id}', [PostController::class, 'update']);
	Route::delete('/posts/{id}', [PostController::class, 'destroy']);
});
