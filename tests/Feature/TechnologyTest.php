<?php

namespace Tests\Feature;

use App\Models\Technology;
use Tests\TestCase;

class TechnologyTest extends TestCase
{
    public function test_can_list_technologys(): void
    {
        Technology::factory(3)->create();
        $response = $this->getJson('/api/technology');

        $response->assertStatus(200)
            ->assertJsonIsArray()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'updated_at',
                    'created_at'
                ]
            ])
            ->assertJsonCount(3);
    }

    public function test_can_get_technology_by_id(): void
    {
        $technology = Technology::factory()->createOne();

        $response = $this->getJson('/api/technology/'.$technology->id);

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $technology->name]);
    }

    public function test_cannot_get_technology_by_invalid_id(): void
    {
        $response = $this->getJson('/api/technology/999999');

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_technology(): void
    {
        $technology = Technology::factory()->makeOne();
        $data = $technology->toArray();

        $response = $this->postJson('/api/technology/', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $technology->name]);
    }

    public function test_can_update_technology(): void
    {
        $technology = Technology::factory()->createOne();
        $data = $technology->toArray();
        $data['name'] = 'New name';

        $response = $this->putJson('/api/technology/'.$technology->id, $data,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => 'New name']);
    }

    public function test_cannot_update_technology_with_invalid_id(): void
    {
        $technology = Technology::factory()->createOne();
        
        $data = $technology->toArray();
        $data['name'] = 'New name';

        $response = $this->putJson('/api/technology/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_technology_by_id(): void
    {
        $technology = Technology::factory()->createOne();

        $response = $this->deleteJson('/api/technology/'.$technology->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_technology_by_invalid_id(): void
    {
        $response = $this->deleteJson('/api/technology/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
