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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->dateTime('date_creation');
            $table->dateTime('date_of_repair')->nullable();
            $table->unsignedBigInteger('technic_type_id')->nullable();
            $table->unsignedBigInteger('broken_type_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->integer('ages_of_technic')->nullable();
            $table->unsignedBigInteger('site_id')->nullable();
            $table->text('comment')->nullable();

            // IDX
            $table->index('client_id', 'order_client_idx');
            // $table->index('status_id', 'order_status_idx');
            $table->index('technic_type_id', 'order_technic_type_idx');
            $table->index('broken_type_id', 'order_broken_type_idx');
            $table->index('brand_id', 'order_brand_idx');
            $table->index('site_id', 'order_site_idx');

            // FK
            $table->foreign('client_id', 'order_client_fk')->on('clients')->references('id');
            // $table->foreign('status_id', 'order_status_fk')->on('statuses')->references('id');
            $table->foreign('technic_type_id', 'order_technic_type_fk')->on('technics_types')->references('id');
            $table->foreign('broken_type_id', 'order_broken_type_fk')->on('broken_types')->references('id');
            $table->foreign('brand_id', 'order_brand_fk')->on('brands')->references('id');
            $table->foreign('site_id', 'order_site_fk')->on('sites')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
