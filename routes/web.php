<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DebtCalculateController;
use App\Http\Controllers\DebtRegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/register', [DebtRegisterController::class, 'register']);
Route::get('/calculate', [DebtCalculateController::class, 'calculate']);
