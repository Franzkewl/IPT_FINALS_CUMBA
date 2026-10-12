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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('first_name');
            $table->string('middle_initial')->nullable();
            $table->string('last_name');
            $table->string('course');
            $table->unsignedTinyInteger('year_level');
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('birthdate');
            $table->string('contact_number', 15)->unique();
            $table->string('email')->unique();
            $table->unsignedInteger('total_borrowed_items')->default(0); // New column for total borrowed items
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
