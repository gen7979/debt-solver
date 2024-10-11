<?php

namespace App\Repositories;

use App\Models\Debt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DebtRepository
{
    public function getAll()
    {
        return Debt::all();
    }

    public function find($id)
    {
        return Debt::find($id);
    }

    public function create(array $data)
    {
        return Debt::create($data);
    }

    public function update($id, array $data)
    {
        $debt = Debt::find($id);
        $debt->update($data);
        return $debt;
    }

    public function delete($id)
    {
        return Debt::destroy($id);
    }

    public function getDebtByUserId($userId)
    {
        return Debt::where('user_id', $userId)->get();
    }

    public function getUpcomingDebts()
    {
        $today = Carbon::today();
        $today = Carbon::parse("2024-10-20");

        $result
        = Debt::where('user_id', Auth::user()->id)
            ->where('repayment_day', '<=', $today->day)
            ->where(function ($query) use ($today) {
                $query->whereRaw('DATE_FORMAT(reminder_checked_date, "%Y-%m") <> ?', [$today->format('Y-m')])
                    ->orWhereNull('reminder_checked_date');
            })
            ->get();
        
        return $result;
    }
}
