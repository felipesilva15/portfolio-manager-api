<?php

namespace Database\Factories;

use App\Enums\ContactStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'email' => fake()->companyEmail(),
            'subject' => fake()->sentence(2),
            'message' => fake()->text(rand(50, 300)),
            'status' => ContactStatus::Pending
        ];
    }
}
