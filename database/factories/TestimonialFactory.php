<?php

namespace Database\Factories;

use App\Enums\SexEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstNameMale(),
            'sex' => SexEnum::Male,
            'date' => fake()->date(),
            'testimonial' => fake()->text(rand(50, 300)),
            'original_url' => fake()->url()
        ];
    }
}
