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
        Schema::create('order_spare_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('spare_part_id')->nullable();
            $table->integer('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('result')->nullable();
            $table->dateTime('created_at');
            $table->text('comment')->nullable();

            // IDX
            $table->index('order_id', 'spare_part_order_idx');
            $table->index('spare_part_id', 'order_spare_part_idx');

            // FK
            $table->foreign('order_id', 'spare_part_order_fk')->on('orders')->references('id');
            $table->foreign('spare_part_id', 'order_spare_part_fk')->on('spare_parts')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_services');
    }
};
