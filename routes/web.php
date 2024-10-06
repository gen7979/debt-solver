<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtRegisterController;
use App\Http\Controllers\DebtCalculateController;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/debt-register', [DebtRegisterController::class, 'index'])->name('debt-register');
    Route::post('/calculate', [DebtCalculateController::class, 'calculate'])->name('calculate');
});

// 設定状況を確認するパス
Route::get('/phpinfo', function () {
    phpinfo();
});

require __DIR__.'/auth.php';
