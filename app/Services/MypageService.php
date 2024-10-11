<?php

namespace App\Services;

use App\Repositories\DebtRepository;

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
     */
    public function getMypageViewData()
    {

        $upcomingDebts = $this->debtRepository->getUpcomingDebts();

        return $upcomingDebts;
    }
}
