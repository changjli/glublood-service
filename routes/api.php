<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\LoggingMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('send-code', [AuthController::class, 'sendCode']);
Route::post('verify-code', [AuthController::class, 'verifyCode']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('change-password', [AuthController::class, 'changePassword']);
Route::get('/test-error', function () {
    throw new \Exception('Test error');
});

Route::middleware('auth:api')->group(function () {
    Route::get('test', function () {
        return response()->json(['data' => 'hello world']);
    });

    Route::get('logout', [AuthController::class, 'logout']);
});
