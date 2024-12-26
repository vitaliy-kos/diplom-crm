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
        Schema::create('clients_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('order_id');
            $table->string('type');
            $table->dateTime('date_start');
            $table->dateTime('date_finish')->nullable();
            $table->unsignedInteger('duration_call')->nullable();
            $table->text('record_link')->nullable();
            $table->text('unique_key')->nullable();
            $table->string('site_page')->nullable();
            $table->text('message')->nullable();

            // IDX
            $table->index('client_id', 'request_client_idx');
            $table->index('order_id', 'request_order_idx');

            // FK
            $table->foreign('client_id', 'request_client_fk')->on('clients')->references('id');
            $table->foreign('order_id', 'request_order_fk')->on('orders')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients_requests');
    }
};
