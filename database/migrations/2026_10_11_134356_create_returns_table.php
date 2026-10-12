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
        Schema::create('returns', function (Blueprint $table) {
            $table->id('return_id');
            $table->unsignedBigInteger('borrowing_id');
                $table->foreign('borrowing_id')->references('borrowing_id')->on('borrowings')->cascadeOnDelete();
            $table->date('returned_date');
            $table->enum('condition', ['good', 'damaged', 'lost'])->default('good');
            $table->unsignedInteger('late_days')->default(0);
            $table->decimal('late_fee', 8, 2)->default(0.00);
            $table->string('received_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};
