<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\MypageService;

use function PHPUnit\Framework\isNull;

class MypageController extends Controller
{
    private $mypageService;
    public function __construct(MypageService $mypageService)
    {
        $this->mypageService = $mypageService;
    }
    /**
     * マイページを表示
     * 
     * @param request
     * @return null|array
     */
    public function index() {
        $upcomingDebts = $this->mypageService->getMypageViewData();
        $data = [
            'upcomingDebts' => $upcomingDebts
        ];

        return view('mypage', $data);
    }

    /**
     * 確認済みボタンを押した際の非同期処理
     */
    public function confirmReminder()
    {
        $today = Carbon::today();
        try {
            Debt::where('user_id', Auth::user()->id)
                ->where('repayment_day', '<=', $today->day)
                ->update([
                    'reminder_checked_date' => $today,
                ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::info($e);
        }
    }
}
