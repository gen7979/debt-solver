<?php

namespace App\Repositories;

use App\Models\Debt;

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
}
