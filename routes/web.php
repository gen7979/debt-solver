<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtRegisterController;
use App\Http\Controllers\DebtCalculateController;

Route::get('/mypage', function () {
    return view('mypage');
})->name('mypage');

Route::get('/', function () {
    return view('login');
})->name('debd-login');

Route::middleware('auth')->group(function () {
    // 借金返済登録フォーム
    Route::get('/debt-register', [DebtRegisterController::class, 'create'])->name('debt-register');
    Route::post('/debt-register', [DebtRegisterController::class, 'store'])->name('debt-register.store');
    Route::put('/debt-register/{id}', [DebtRegisterController::class, 'update'])->name('debt-register.update');
    // 借金状況確認ページ
    Route::get('/calculate', [DebtCalculateController::class, 'index'])->name('calculate');
});

// 設定状況を確認するパス
Route::get('/phpinfo', function () {
    phpinfo();
});

require __DIR__.'/auth.php';
