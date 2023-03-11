<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\TransactionController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/health-check', function () {
        return [
            'timestamp' => date('Y-m-d H:i:s'),
            'env' => config('app.env'),
            'status' => 'true',
        ];
    });
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/banks', [BankController::class, 'banks']);

    Route::get('/user-bank-account', [BankController::class, 'getUserAccount']);

    Route::post('/user-transfer', [BankController::class, 'userTransfer']);
    Route::post('/bank-transfer', [BankController::class, 'bankTransfer']);

    Route::get('/transaction-history', [TransactionController::class, 'index']);
});
