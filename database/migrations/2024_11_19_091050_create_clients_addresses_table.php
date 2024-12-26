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
        Schema::create('clients_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('metro_station_id')->nullable();
            $table->string('street')->nullable();
            $table->string('home')->nullable();
            $table->string('entrance')->nullable();
            $table->string('flat')->nullable();
            $table->string('floor')->nullable();
            $table->string('code')->nullable();

            // IDX
            $table->index('client_id', 'address_client_idx');
            $table->index('metro_station_id', 'address_metro_station_idx');

            // FK
            $table->foreign('client_id', 'address_client_fk')->on('clients')->references('id');
            $table->foreign('metro_station_id', 'address_metro_station_fk')->on('metro_stations')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients_addresses');
    }
};
