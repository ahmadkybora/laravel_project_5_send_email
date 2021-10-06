<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Profile\CartController;
use App\Http\Controllers\Profile\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    // panel routes
    Route::namespace('Panel')->prefix('panel')->group(function () {
        Route::get('users/{id}', [UserController::class, 'show']);
        Route::get('users', [UserController::class, 'index']);
        Route::post('users', [UserController::class, 'store']);
        Route::patch('users/{id}', [UserController::class, 'update']);
        Route::delete('users/{id}', [UserController::class, 'destroy']);
        //Route::apiResource('users', UserController::class);
    });

    // profile routes
    Route::middleware('profile')->group(function() {
        Route::namespace('Profile')->prefix('profile')->middleware('verified')->group(function() {
            Route::get('cart', [CartController::class, 'getCart']);
            //Route::post('remove/cart', [CartController::class], 'removeFromCart');
            //Route::get('add/cart', [CartController::class], 'addToCart');
            //Route::get('cart', [CartController::class], 'getCart');
        });
    });
});

Route::get('/verify-email/{user:username}/{timestamp}', [AuthController::class, 'verifyEmail'])->name('verify-email');
