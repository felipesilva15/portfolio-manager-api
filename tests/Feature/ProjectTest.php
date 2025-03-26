<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Tag;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    public function test_can_list_projects(): void
    {
        Project::factory()
                    ->has(Tag::factory()->count(2))
                    ->count(2)
                    ->create();
        
        $response = $this->getJson('/api/project', $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsArray()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'description',
                    'completion_date',
                    'thumbnail_url',
                    'status',
                    'tags' => [
                        '*' => [
                            'id',
                            'name'
                        ]
                    ],
                    'updated_at',
                    'created_at'
                ]
            ])
            ->assertJsonCount(2);
    }

    public function test_can_get_project_by_id(): void
    {
        $project = Project::factory()
                        ->has(Tag::factory()->count(3))
                        ->createOne();

        $response = $this->getJson('/api/project/'.$project->id,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'title',
                'description',
                'completion_date',
                'thumbnail_url',
                'status',
                'tags' => [
                    '*' => [
                        'id',
                        'name'
                    ]
                ],
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['title' => $project->title]);
    }

    public function test_cannot_get_project_by_invalid_id(): void
    {
        $response = $this->getJson('/api/project/999999',  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_project(): void
    {
        $project = Project::factory()->makeOne();
        $tags = Tag::factory(3)->create();
        $project->setRelation('tags', $tags);

        $data = $project->toArray();

        $response = $this->postJson('/api/project/', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'title',
                'description',
                'completion_date',
                'thumbnail_url',
                'status',
                'tags' => [
                    '*' => [
                        'id',
                        'name'
                    ]
                ],
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['title' => $project->title]);
    }

    public function test_can_update_project(): void
    {
        $project = Project::factory()
                            ->has(Tag::factory()->count(3))
                            ->createOne();
        $tags = Tag::factory(3)->create();
        $project->setRelation('tags', $tags);
        
        $data = $project->toArray();
        $data['title'] = 'New title';

        $response = $this->putJson('/api/project/'.$project->id, $data,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'title',
                'description',
                'completion_date',
                'thumbnail_url',
                'status',
                'tags' => [
                    '*' => [
                        'id',
                        'name'
                    ]
                ],
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['title' => 'New title']);
    }

    public function test_cannot_update_project_with_invalid_id(): void
    {
        $project = Project::factory()->createOne();
        
        $data = $project->toArray();
        $data['title'] = 'New title';

        $response = $this->putJson('/api/project/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_project_by_id(): void
    {
        $project = Project::factory()->createOne();

        $response = $this->deleteJson('/api/project/'.$project->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_project_by_invalid_id(): void
    {
        $response = $this->deleteJson('/api/project/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_get_tags_by_project_id(): void
    {
        $project = Project::factory()
                            ->has(Tag::factory()->count(3))
                            ->createOne();

        $response = $this->getJson('/api/project/'.$project->id.'/tags',  $this->getAuthHeaders());

        $response->assertStatus(200)
                    ->assertJsonStructure([
                        '*' => [
                            'id',
                            'name'
                        ]
                    ]);
    }

    public function test_cannot_get_tags_with_invalid_project_id(): void
    {
        $response = $this->getJson('/api/project/999999/tags',  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
