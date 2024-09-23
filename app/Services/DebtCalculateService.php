<?php

namespace App\Services;

class DebtCalculateService
{

  /**
   * 提供されたパラメータに基づいて支払い期間・総額・総利息を計算
   *
   * @param string $companyName 会社名
   * @param int $loanAmount 借入金額
   * @param float $interestRates 利息
   * @param int $repaymentAmount 毎月の返済金額
   * @return array 計算結果の配列
   */
  public function debtCalculate(
    $companyName,
    int $loanAmount,
    int $interestRates,
    int $repaymentAmount
  )
  {
    $totalInterest = 0;
    $totalAmount = $loanAmount;
    $repaymentPeriods = 0;

    while ($loanAmount > 0) {
      // 利息を計算
      $commission = floor($loanAmount * ($interestRates / 100) / 12);
      // 利息を加算し、総利息を計算
      $totalInterest += $commission;
      // 総額を加算し、総額を計算
      $totalAmount += $commission;
      // 借入金額を減算し、借入金額を計算
      $loanAmount -= $repaymentAmount - $commission;
      // 返済期間を計算
      $repaymentPeriods++;
    }

    return [
      'totalAmount' => $totalAmount,           // 総額
      'totalInterest' => $totalInterest,       // 総利息
      'repaymentPeriods' => $repaymentPeriods  // 返済期間
    ];
  }
}
