<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'equipment_name' => $this->faker->randomElement([
            'Basketball', 'LCD Projector', 'Microscope', 'Laptop', 'Volleyball Net',
            'Digital Scale', 'Acoustic Guitar', 'Cordless Drill', 'Portable Speaker',
            'Safety Goggles', 'Tablet', 'Keyboard',
        ]),
        'description'    => $this->faker->sentence(),
        'quantity'       => $this->faker->numberBetween(1, 10),
        'category_id'    => Category::inRandomOrder()->value('category_id'),
        'status'         => $this->faker->randomElement(['available', 'borrowed', 'maintenance']),
    ];
    }
}
