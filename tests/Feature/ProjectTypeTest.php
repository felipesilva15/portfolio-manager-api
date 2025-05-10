<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProjectTypeTest extends TestCase
{
    public function test_can_list_project_types(): void
    {
        ProjectType::factory(3)->create();
        $response = $this->getJson('/api/project_type');

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

    public function test_can_get_project_type_by_id(): void
    {
        $project_type = ProjectType::factory()->createOne();

        $response = $this->getJson('/api/project_type/'.$project_type->id);

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $project_type->name]);
    }

    public function test_cannot_get_project_type_by_invalid_id(): void
    {
        $response = $this->getJson('/api/project_type/999999');

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_project_type(): void
    {
        $project_type = ProjectType::factory()->makeOne();
        $data = $project_type->toArray();

        $response = $this->postJson('/api/project_type/', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $project_type->name]);
    }

    public function test_can_update_project_type(): void
    {
        $project_type = ProjectType::factory()->createOne();
        $data = $project_type->toArray();
        $data['name'] = 'New name';

        $response = $this->putJson('/api/project_type/'.$project_type->id, $data,  $this->getAuthHeaders());

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

    public function test_cannot_update_project_type_with_invalid_id(): void
    {
        $project_type = ProjectType::factory()->createOne();
        
        $data = $project_type->toArray();
        $data['name'] = 'New name';

        $response = $this->putJson('/api/project_type/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_project_type_by_id(): void
    {
        $project_type = ProjectType::factory()->createOne();

        $response = $this->deleteJson('/api/project_type/'.$project_type->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_project_type_by_invalid_id(): void
    {
        $response = $this->deleteJson('/api/project_type/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
