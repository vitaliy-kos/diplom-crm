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
        Schema::create('order_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->text('comment')->nullable();
            $table->integer('sum_pay')->nullable();
            $table->integer('our_percent')->nullable();
            $table->float('profit')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('paid_at')->nullable();

            // IDX
            $table->index('service_id', 'order_service_idx');

            // FK
            $table->foreign('service_id', 'order_service_fk')->on('services')->references('id');
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
