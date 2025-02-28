<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'institution_name' => fake()->company(),
            'degree' => fake()->jobTitle(),
            'locality' => fake()->city(),
            'start_date' => fake()->date(),
            'end_date' => null
        ];
    }
}
