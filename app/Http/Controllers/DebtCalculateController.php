<?php

namespace App\Http\Controllers;

use App\Services\DebtCalculateService;
use Illuminate\Http\Request;

class DebtCalculateController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param DebtCalculateService $debtCalculateService 借金計算サービス
     */
    public function __construct(
        protected DebtCalculateService $debtCalculateService
    )
    {}

    /**
     * 計算ページ
     *
     * @param Request $request リクエスト
     * @return \Illuminate\View\View 計算結果のビュー
     */
    public function calculate(Request $request)
    {
        // リクエストされたデータを受信
        $requestCompanyName = $request->company;          // 会社名
        $requestLoanAmount = $request->loanAmount;        // 借入金額
        $requestInterestRates = $request->interestRates;  // 利息
        $requestRepaymentAmount = $request->repaymentAmount;  // 毎月の返済金額

        // 計算
        $calculateData = $this->debtCalculateService->debtCalculate(
            $requestCompanyName, $requestLoanAmount, $requestInterestRates, $requestRepaymentAmount
        );

        // 計算結果をビューに渡す
        $data = [
            'calculateData' => $calculateData,
            'companyName' => $requestCompanyName,
            'loanAmount' => $requestLoanAmount,
            'interestRates' => $requestInterestRates,
            'repaymentAmount' => $requestRepaymentAmount,
        ];
        return view('calculate', $data);
    }
}
