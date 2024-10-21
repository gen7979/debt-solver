<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('debts', function (Blueprint $table) {
            $table->date('reminder_checked_date')->nullable()->after('is_repaid');
            $table->dropColumn('is_repaid');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('debts', function (Blueprint $table) {
            $table->dropColumn('reminder_checked_date');
            $table->boolean('is_repaid')->default(false)->after('repayment_day');
        });
    }
};
