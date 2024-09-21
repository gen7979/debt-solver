<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebtCalculateController extends Controller
{
    public function calculate()
    {
        return view('calculate');
    }
}
