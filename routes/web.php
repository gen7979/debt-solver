<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DebtCalculateController;
use App\Http\Controllers\DebtRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index']);

Route::get('/register', [DebtRegisterController::class, 'index']);
Route::post('/calculate', [DebtCalculateController::class, 'calculate']);

// 設定状況を確認するパス
Route::get('/phpinfo', function () {
    phpinfo();
});
