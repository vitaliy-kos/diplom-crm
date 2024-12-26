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
        Schema::table('order_services', function (Blueprint $table) {
            $table->integer('minus_spare')->after('sum_pay')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_services', function (Blueprint $table) {
            $table->dropColumn('minus_spare');
        });
    }
};
