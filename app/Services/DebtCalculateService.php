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
   * 提供されたパラメータに基づいて支払い期間・総額・総利息を計算
   *
   * @return array 計算結果の配列
   */
  public function debtCalculate(
  )
  {
    $debtData = $this->debtRepository->getDebtByUserId(Auth::user()->id);

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

    return [
      'companyName' => $debtData->company_name,    // 会社名
      'loanAmount' => $debtData->remaining_amount,
      'interestRates' => $interestRate,
      'repaymentAmount' => $repaymentAmount,
      'totalAmount' => $totalAmount,           // 総額
      'totalInterest' => $totalInterest,       // 総利息
      'repaymentPeriods' => $repaymentPeriods,  // 返済期間
      'repaymentSchedule' => $schedule         // 返済スケジュール
    ];
  }
}
