<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $completed = rand(0, 100) % 2 == 0 ? true : false;

        return [
            'title' => fake()->domainName(),
            'description' => fake()->text(),
            'completion_date' => $completed ? fake()->date() : null,
            'thumbnail_url' => fake()->imageUrl(),
            'status' => $completed ? ProjectStatus::Completed : ProjectStatus::Pending,
            'url' => fake()->url(),
            'github_url' => fake()->url()
        ];
    }
}
