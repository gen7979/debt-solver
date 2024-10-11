<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isNull;

class MypageController extends Controller
{
    /**
     * マイページを表示
     * 
     * @param request
     * @return null|array
     */
    public function index(Request $request) {
        // デバッグ用にセッションを削除
        $request->session()->forget('logged_in_today');

        // 初回ログインかどうかを確認するためにsessionを利用
        if (!$request->session()->has('logged_in_today')) {

            // 初回ログインの場合、セッションにフラグをセット
            $request->session()->put('logged_in_today', true);

            // フラグの状況を確認
            $upcomingDebts = Debt::where('user_id', Auth::user()->id)
                    ->where('repayment_day', '<=', date('d') + 7)
                    ->where('reminder_seen', Debt::REMINDER_SEEN_STATUS['false'])
                    ->get();

            // データの取得有無に応じて処理を分岐
            if (isNull( $upcomingDebts )) {
                // 未取得の場合はデータ無しでマイページを表示
                return view('mypage');
            } else {
                // 取得した場合は取得データをマイページに送る
                $data = [
                    'upcomingDebts' => $upcomingDebts
                ];

                return view('mypage', $data);
            }
        }

        return view('mypage');
    }

    /**
     * 確認済みボタンを押した際の非同期処理
     */
    public function confirmReminder()
    {
        try {
            $userId =  Auth::user()->id;
            Debt::where('user_id', $userId)
                ->where('repayment_day', '<=', date('d') + 7)
                ->update(['reminder_seen' => Debt::REMINDER_SEEN_STATUS['true']]);
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::info($e);
        }
    }
}
