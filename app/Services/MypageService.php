<?php

namespace App\Services;

use App\Repositories\DebtRepository;
use Carbon\Carbon;

class MypageService
{
    protected $debtRepository;

    public function __construct(DebtRepository $debtRepository)
    {
        $this->debtRepository = $debtRepository;
    }

    /**
     * マイページ表示用データを取得
     * 
     * @param array $result
     */
    public function getMypageViewData()
    {
        $today = Carbon::today();

        $userDebtsData = $this->debtRepository->getUpcomingDebts();
        $result = [];

        // DBからデータを取得できた場合は以下の処理を行う
        if (!$userDebtsData->isEmpty()) {
            foreach ($userDebtsData as $data) {
                $startDate = Carbon::parse($data->reminder_checked_date);
                if ($data->reminder_checked_date) {
                    $endDate = $today;
                    $result[$data->company_name] = [];
    
                    while ($startDate->lte($endDate)) {
                        $result[$data->company_name][$startDate->format('Y年m月')] = [
                            'repaymentDay' => $data->repayment_day,
                            'repaymentAmount' => $data->repayment_amount,
                        ];
    
                        $startDate->addMonth();
                    }
                } else {
                    $result[$data->company_name][$startDate->format('Y年m月')] = [
                        'repaymentDay' => $data->repayment_day,
                        'repaymentAmount' => $data->repayment_amount,
                    ];
                }
            }
        }

        return $result;
    }
}
