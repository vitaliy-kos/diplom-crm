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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->dateTime('date');
            $table->unsignedInteger('sum');
            $table->text('comment')->nullable();
            $table->softDeletes();

            // IDX
            $table->index('type_id', 'expense_type_idx');

            // FK
            $table->foreign('type_id', 'expense_type_fk')->on('expense_types')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
