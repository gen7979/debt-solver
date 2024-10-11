<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    const REMINDER_SEEN_STATUS = [
        'false' => 0,
        'true' => 1,
    ];
}
