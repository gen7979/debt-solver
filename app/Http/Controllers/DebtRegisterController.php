<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DebtRegisterController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'remaining_amount' => 'required|integer|min:0',
            'interest_rate' => 'required|numeric|min:0',
            'repayment_amount' => 'required|integer|min:0',
            'repayment_day' => 'required|integer|min:1|max:31',
        ]);

        // 同じ user_id と company_name の組み合わせが存在するか確認
        $existingDebt = Debt::where('user_id', Auth::user()->id)
            ->where('company_name', $validatedData['company_name'])
            ->first();

        if ($existingDebt) {
            // エラーメッセージを返す
            throw ValidationException::withMessages([
                'company_name' => '入力された企業名は既に登録されています。変更する場合はマイページから変更してください。',
            ]);
        }

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

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'remaining_amount' => 'required|integer|min:0',
            'interest_rate' => 'required|numeric|min:0',
            'repayment_amount' => 'required|integer|min:0',
            'repayment_day' => 'required|integer|min:1|max:31',
        ]);
        $debt = Debt::find($id);
        $debt->company_name = $validatedData['company_name'];
        $debt->remaining_amount = $validatedData['remaining_amount'];
        $debt->interest_rate = $validatedData['interest_rate'];
        $debt->repayment_amount = $validatedData['repayment_amount'];
        $debt->repayment_day = $validatedData['repayment_day'];
        $debt->save();
        return redirect()->route('calculate');
    }
}
