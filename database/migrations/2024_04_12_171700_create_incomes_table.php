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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->dateTime('date');
            $table->unsignedInteger('sum');
            $table->text('comment')->nullable();
            $table->softDeletes();

            // IDX
            $table->index('type_id', 'income_type_idx');

            // FK
            $table->foreign('type_id', 'income_type_fk')->on('income_types')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
