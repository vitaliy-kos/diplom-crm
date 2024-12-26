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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->string('object');
            $table->unsignedBigInteger('id_object');
            $table->string('action');
            $table->text('action_value')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            // IDX
            $table->index('user_id', 'user_log_idx');

            // FK
            $table->foreign('user_id', 'user_log_fk')->on('users')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
