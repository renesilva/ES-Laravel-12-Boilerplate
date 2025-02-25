<?php

use App\Http\Controllers\API\TestController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('test', [TestController::class, 'testGet']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('test/test-logged-in', [TestController::class, 'testLoggedIn']);
});

// Auth routes
Route::get('/login', function () {
    return response()->json([
        'success' => false,
        'message' => 'Unauthorized'
    ])->setStatusCode(401);
})->name('login');
Route::controller(AuthController::class)->group(function () {
    Route::post('auth/login', 'login');
    Route::post('auth/logout', 'logout');
    Route::post('auth/refresh', 'refresh');
    Route::post('auth/forgot-password', 'forgotPassword');
});
