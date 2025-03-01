<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certification>
 */
class CertificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'institution_name' => fake()->company(),
            'issued_date' => fake()->date(),
            'expiration_date' => null,
            'credential_id' => fake()->uuid(),
            'credential_url' => fake()->url()
        ];
    }
}
