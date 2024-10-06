<?php

namespace App\Http\Controllers;

use App\Services\DebtCalculateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function index(Request $request)
    {
        // 計算
        $calculateData = $this->debtCalculateService->debtCalculate();


        return view('calculate', $calculateData);
    }
}
