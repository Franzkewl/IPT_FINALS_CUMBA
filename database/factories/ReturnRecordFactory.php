<?php

namespace Database\Factories;

use App\Models\ReturnRecord;
use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ReturnRecord>
 */
class ReturnRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'borrowing_id'  => Borrowing::inRandomOrder()->value('borrowing_id'),  
            'returned_date' => now()->toDateString(),
            'condition'     => $this->faker->randomElement(['good', 'damaged', 'lost']),   
            'late_days'     => 0,
            'late_fee'      => 0,
            'received_by'   => $this->faker->name(),
        ];
    }
}
