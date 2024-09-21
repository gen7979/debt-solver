<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DebtCalculateController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/calculate', [DebtCalculateController::class, 'calculate']);
