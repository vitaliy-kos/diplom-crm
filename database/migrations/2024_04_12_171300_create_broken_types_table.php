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
        Schema::create('broken_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('technic_type_id')->nullable();
            $table->string('description');
            $table->softDeletes();

            // IDX
            $table->index('technic_type_id', 'broken_type_technic_type_idx');

            // FK
            $table->foreign('technic_type_id', 'broken_type_technic_type_fk')->on('technics_types')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broken_types');
    }
};
