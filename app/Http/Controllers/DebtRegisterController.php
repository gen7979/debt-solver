<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebtRegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
}
