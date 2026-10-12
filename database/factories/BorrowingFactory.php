<?php

namespace Database\Factories;

use App\Models\Borrowing;
use App\Models\Student;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $borrowed = $this->faker->dateTimeBetween('-30 days', '-1 day');

        return [
            'student_id' => Student::inRandomOrder()->value('student_id'),
            'equipment_id' => Equipment::inRandomOrder()->value('equipment_id'),
            'borrowed_date' => $borrowed,
            'due_date' => (clone $borrowed)->modify('+7 days'),
            'purpose' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['borrowed', 'returned', 'overdue']),
            'released_by' => $this->faker->name(),
        ];
    }
}
