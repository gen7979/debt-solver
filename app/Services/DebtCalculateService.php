<?php

namespace App\Services;

use App\Repositories\DebtRepository;
use Illuminate\Support\Facades\Auth;

class DebtCalculateService
{
    protected $debtRepository;

    public function __construct(DebtRepository $debtRepository)
    {
        $this->debtRepository = $debtRepository;
    }

    /**
     * 支払い期間・総額・総利息を計算する
     *
     * @return array 計算結果の配列
     */
    public function calculateDebt()
    {
        $data = $this->debtRepository->getDebtByUserId(Auth::user()->id);

        // 表示データがない場合は空配列を返す
        if (is_null($data)) {
            return [];
        }

        $viewData = [];

        foreach ($data as $debtData) {
            $totalInterest = 0;                              // 総利息
            $remainingAmount = $debtData->remaining_amount;  // 借入金額
            $interestRate = $debtData->interest_rate;        // 利率
            $totalAmount = $remainingAmount;                  // 総額
            $repaymentAmount = $debtData->repayment_amount;  // 毎月の返済金額
            $repaymentDay = $debtData->repayment_day;        // 返済日
            $repaymentPeriods = 0;                           // 返済期間
            $schedule = [];                                  // 返済スケジュール
    
            while ($remainingAmount > 0) {
                // 利息を計算
                $commission = floor($totalAmount * ($debtData->interest_rate / 100) / 12);
                // 利息を加算し、総利息を計算
                $totalInterest += $commission;
                // 総額を加算し、総額を計算
                $totalAmount += $commission;
                // 借入金額を減算し、借入金額を計算
                $remainingAmount -= $repaymentAmount - $commission;
                // 返済期間を計算
                $repaymentPeriods++;

                // 返済スケジュールを計算
                $schedule[$repaymentPeriods . "ヶ月目"] = [
                    'repaymentAmount' => $repaymentAmount,
                    'interestAmount' => $commission,
                    'remainingBalance' => max(0, $remainingAmount),
                    'repaymentDay' => $repaymentDay,
                ];
            }

            $viewData[$debtData->company_name] = [
                'id' => $debtData->id,
                'companyName' => $debtData->company_name,    // 会社名
                'loanAmount' => $debtData->remaining_amount, // 残債
                'interestRates' => $interestRate,           // 利率
                'repaymentAmount' => $repaymentAmount,     // 毎月の返済金額
                'repaymentDay' => $repaymentDay,           // 返済日
                'totalAmount' => $totalAmount,             // 総額
                'totalInterest' => $totalInterest,         // 総利息
                'repaymentPeriods' => $repaymentPeriods,    // 返済期間
                'repaymentSchedule' => $schedule           // 返済スケジュール
            ];
        }

        return $viewData;
    }
}
