<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debt;
use Illuminate\Support\Facades\Auth;
class DebtRegisterController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->all();
        // validate([
        //     'company_name' => 'required|string|max:255',
        //     'remaining_amount' => 'required|integer|min:0',
        //     'interest_rate' => 'required|numeric|min:0',
        //     'repayment_amount' => 'required|integer|min:0',
        //     'repayment_day' => 'required|integer|min:1|max:31',
        // ]);

        $debt = new Debt();
        $debt->user_id = Auth::user()->id;
        $debt->company_name = $validatedData['company_name'];
        $debt->remaining_amount = $validatedData['remaining_amount'];
        $debt->interest_rate = $validatedData['interest_rate'];
        $debt->repayment_amount = $validatedData['repayment_amount'];
        $debt->repayment_day = $validatedData['repayment_day'];
        $debt->save();

        return redirect()->route('calculate');
    }
}
