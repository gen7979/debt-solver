<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebtCalculateController extends Controller
{
    public function calculate(Request $request)
    {
        // リクエストされたデータを受信
        $companyName = $request->company;                      // 会社名
        $loanAmount = $request->loanAmount;                    // 借入金額
        $monthlyInterestRate = $request->monthlyInterestRate;  // 金利
        $repaymentAmount = $request->repaymentAmount;          // 毎月の返済金額

        $data = [
            'companyName' => $companyName,
            'loanAmount' => $loanAmount,
            'monthlyInterestRate' => $monthlyInterestRate,
            'repaymentAmount' => $repaymentAmount,
        ];
        return view('calculate', $data);
    }
}
