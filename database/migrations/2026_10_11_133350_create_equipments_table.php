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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id('equipment_id');
            $table->string('equipment_name');
            $table->text('description')->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('category_id');
                $table->foreign('category_id')->references('category_id')->on('categories')->restrictOnDelete();
            $table->enum('status', ['available', 'borrowed', 'maintenance'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
