<?php

namespace Tests\Feature;

use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    public function test_can_list_tags(): void
    {
        Tag::factory(3)->create();
        $response = $this->getJson('/api/tag');

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

    public function test_can_get_tag_by_id(): void
    {
        $tag = Tag::factory()->createOne();

        $response = $this->getJson('/api/tag/'.$tag->id);

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $tag->name]);
    }

    public function test_cannot_get_tag_by_invalid_id(): void
    {
        $response = $this->getJson('/api/tag/999999');

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_tag(): void
    {
        $tag = Tag::factory()->makeOne();
        $data = $tag->toArray();

        $response = $this->postJson('/api/tag/', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $tag->name]);
    }

    public function test_can_update_tag(): void
    {
        $tag = Tag::factory()->createOne();
        $data = $tag->toArray();
        $data['name'] = 'New name';

        $response = $this->putJson('/api/tag/'.$tag->id, $data,  $this->getAuthHeaders());

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

    public function test_cannot_update_tag_with_invalid_id(): void
    {
        $tag = Tag::factory()->createOne();
        
        $data = $tag->toArray();
        $data['name'] = 'New name';

        $response = $this->putJson('/api/tag/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_tag_by_id(): void
    {
        $tag = Tag::factory()->createOne();

        $response = $this->deleteJson('/api/tag/'.$tag->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_tag_by_invalid_id(): void
    {
        $response = $this->deleteJson('/api/tag/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_get_projects_by_tag_id(): void
    {
        $tag = Tag::factory()->createOne();

        $response = $this->getJson('/api/tag/'.$tag->id.'/projects',  $this->getAuthHeaders());

        $response->assertStatus(200)
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
                    ]);
    }

    public function test_cannot_get_projects_with_invalid_tag_id(): void
    {
        $response = $this->getJson('/api/tag/999999/projects',  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
