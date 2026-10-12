<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'middle_initial' => $this->faker->randomLetter(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'course' => $this->faker->randomElement(['BSIT', 'BSCS', 'BSECE', 'BSIS']),
            'year_level' => $this->faker->numberBetween(1, 4),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'birthdate' => $this->faker->date(),
            'contact_number' => fake()->numerify('09#########'),
        ];
    }
}
