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

        // 表示データを取得
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

        // 変数を初期化
        $totalInterest = 0;
        $loanAmount = 0;
        $totalAmount = 0;
        $repaymentAmount = 0;
        $schedule = [];

        foreach ($viewData as $data) {
            $totalInterest += $data['totalInterest'];      // 総利息 
            $loanAmount += $data['loanAmount'];       // 借入金額
            $totalAmount += $data['totalAmount'];          // 総額
            $repaymentAmount += $data['repaymentAmount'];  // 毎月の返済金額

            // 返済スケジュールを計算
            foreach ($data['repaymentSchedule'] as $repaymentPeriods => $value) {
                if (!isset($schedule[$repaymentPeriods])) {
                    $schedule[$repaymentPeriods] = [
                        'repaymentAmount' => $value['repaymentAmount'],
                        'interestAmount' => $value['interestAmount'],
                        'remainingBalance' => $value['remainingBalance'],
                    ];
                } else {
                    $schedule[$repaymentPeriods]['repaymentAmount'] += $value['repaymentAmount'];
                    $schedule[$repaymentPeriods]['interestAmount'] += $value['interestAmount'];
                    $schedule[$repaymentPeriods]['remainingBalance'] += $value['remainingBalance'];
                }
            }
        }

        $totalData = [
            'loanAmount' => $loanAmount, // 残債
            'totalAmount' => $totalAmount,             // 総額
            'totalInterest' => $totalInterest,         // 総利息
            'repaymentAmount' => $repaymentAmount,     // 毎月の返済金額
            'repaymentPeriods' => count($schedule),    // 返済期間
            'repaymentSchedule' => $schedule           // 返済スケジュール
        ];

        return [
            'totalData' => $totalData,
            'viewData' => $viewData,
        ];
    }
}
