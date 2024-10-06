<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtRegisterController;
use App\Http\Controllers\DebtCalculateController;

Route::get('/', function () {
    return view('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/debt-register', [DebtRegisterController::class, 'index'])->name('debt-register');
    Route::post('/calculate', [DebtCalculateController::class, 'calculate'])->name('calculate');
});

// 設定状況を確認するパス
Route::get('/phpinfo', function () {
    phpinfo();
});

require __DIR__.'/auth.php';
