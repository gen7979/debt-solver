<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index(Request $request) {
        // デバッグ用にセッションを削除
        $request->session()->forget('logged_in_today');

        // 初回ログインかどうかを確認するためにsessionを利用
        if (!$request->session()->has('logged_in_today')) {

            // 初回ログインの場合、セッションにフラグをセット
            $request->session()->put('logged_in_today', true);

            // フラグの状況を確認
            $upcomingDebts = Debt::where('user_id', Auth::user()->id)
                    ->where('repayment_day', '<=', now()->addDays(7))
                    ->where('reminder_seen', Debt::REMINDER_SEEN_STATUS['false'])
                    ->get();

            $data = [
                'upcomingDebts' => $upcomingDebts
            ];
            // モーダルを表示するかどうかをフラグでmypageに渡す
            return view('mypage', $data);
        }

        return view('mypage');
    }
}
