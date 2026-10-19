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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id('borrowing_id');
            $table->unsignedBigInteger('student_id');
                $table->foreign('student_id')->references('student_id')->on('students')->restrictOnDelete();
            $table->unsignedBigInteger('equipment_id');
                $table->foreign('equipment_id')->references('equipment_id')->on('equipments')->restrictOnDelete();
            $table->date('borrowed_date');
            $table->date('due_date');
            $table->string('purpose');
            $table->enum('status', ['borrowed', 'overdue'])->default('borrowed');
            $table->string('released_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
