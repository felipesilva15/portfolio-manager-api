<?php

namespace Tests\Feature;

use App\Models\Skill;
use Tests\TestCase;

class SkillTest extends TestCase
{
    public function test_can_list_skills(): void
    {
        Skill::factory(3)->create();
        $response = $this->getJson('/api/skill');

        $response->assertStatus(200)
            ->assertJsonIsArray()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'icon_url',
                    'updated_at',
                    'created_at'
                ]
            ])
            ->assertJsonCount(3);
    }

    public function test_can_get_skill_by_id(): void
    {
        $skill = Skill::factory()->createOne();

        $response = $this->getJson('/api/skill/'.$skill->id);

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'title',
                'icon_url',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['title' => $skill->title]);
    }

    public function test_cannot_get_skill_by_invalid_id(): void
    {
        $response = $this->getJson('/api/skill/999999');

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_skill(): void
    {
        $skill = Skill::factory()->makeOne();
        $data = $skill->toArray();

        $response = $this->postJson('/api/skill/', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'title',
                'icon_url',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['title' => $skill->title]);
    }

    public function test_can_update_skill(): void
    {
        $skill = Skill::factory()->createOne();
        $data = $skill->toArray();
        $data['title'] = 'New title';

        $response = $this->putJson('/api/skill/'.$skill->id, $data,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'title',
                'icon_url',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['title' => 'New title']);
    }

    public function test_cannot_update_skill_with_invalid_id(): void
    {
        $skill = Skill::factory()->createOne();
        
        $data = $skill->toArray();
        $data['title'] = 'New title';

        $response = $this->putJson('/api/skill/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_skill_by_id(): void
    {
        $skill = Skill::factory()->createOne();

        $response = $this->deleteJson('/api/skill/'.$skill->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_skill_by_invalid_id(): void
    {
        $response = $this->deleteJson('/api/skill/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
