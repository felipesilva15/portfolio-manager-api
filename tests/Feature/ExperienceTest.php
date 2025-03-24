<?php

namespace Tests\Feature;

use App\Models\Experience;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    public function test_can_list_experiences(): void
    {
        Experience::factory(3)->create();
        $response = $this->getJson('/api/experience', $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsArray()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'company_name',
                    'position',
                    'locality',
                    'description',
                    'start_date',
                    'end_date',
                    'updated_at',
                    'created_at'
                ]
            ])
            ->assertJsonCount(3);
    }

    public function test_can_get_experience_by_id(): void
    {
        $experience = Experience::factory()->createOne();

        $response = $this->getJson('/api/experience/'.$experience->id,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'company_name',
                'position',
                'locality',
                'description',
                'start_date',
                'end_date',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['position' => $experience->position]);
    }

    public function test_cannot_get_experience_by_invalid_id(): void
    {
        $response = $this->getJson('/api/experience/999999',  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_experience(): void
    {
        $experience = Experience::factory()->makeOne();
        $data = $experience->toArray();

        $response = $this->postJson('/api/experience/', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'company_name',
                'position',
                'locality',
                'description',
                'start_date',
                'end_date',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['position' => $experience->position]);
    }

    public function test_can_update_experience(): void
    {
        $experience = Experience::factory()->createOne();
        
        $data = $experience->toArray();
        $data['position'] = 'New position';

        $response = $this->putJson('/api/experience/'.$experience->id, $data,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'company_name',
                'position',
                'locality',
                'description',
                'start_date',
                'end_date',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['position' => 'New position']);
    }

    public function test_cannot_update_experience_with_invalid_id(): void
    {
        $experience = Experience::factory()->createOne();
        
        $data = $experience->toArray();
        $data['position'] = 'New position';

        $response = $this->putJson('/api/experience/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_experience_by_id(): void
    {
        $experience = Experience::factory()->createOne();

        $response = $this->deleteJson('/api/experience/'.$experience->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_experience_by_invalid_id(): void
    {
        $response = $this->deleteJson('/api/experience/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
