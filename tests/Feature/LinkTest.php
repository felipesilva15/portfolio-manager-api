<?php

namespace Tests\Feature;

use App\Models\Link;
use App\Models\User;
use Tests\TestCase;

class LinkTest extends TestCase
{
    public function test_can_list_links(): void
    {
        Link::factory()
            ->count(3)
            ->for(User::factory())
            ->create();
        $response = $this->getJson('/api/link');

        $response->assertStatus(200)
            ->assertJsonIsArray()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'user_id',
                    'label',
                    'url',
                    'icon_name',
                    'updated_at',
                    'created_at'
                ]
            ])
            ->assertJsonCount(3);
    }

    public function test_can_get_link_by_id(): void
    {
        $link = Link::factory()
                    ->for(User::factory())
                    ->createOne();

        $response = $this->getJson('/api/link/'.$link->id);

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'user_id',
                'label',
                'url',
                'icon_name',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['label' => $link->label]);
    }

    public function test_cannot_get_link_by_invalid_id(): void
    {
        $response = $this->getJson('/api/link/999999');

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_link(): void
    {
        $link = Link::factory()->makeOne();
        $user = User::factory()->createOne();
        $link->user_id = $user->id;
        $data = $link->toArray();

        $response = $this->postJson('/api/link/', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'user_id',
                'label',
                'url',
                'icon_name',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['label' => $link->label]);
    }

    public function test_can_update_link(): void
    {
        $link = Link::factory()
                    ->for(User::factory())
                    ->createOne();
        $data = $link->toArray();
        $data['label'] = 'New label';

        $response = $this->putJson('/api/link/'.$link->id, $data,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'user_id',
                'label',
                'url',
                'icon_name',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['label' => 'New label']);
    }

    public function test_cannot_update_link_with_invalid_id(): void
    {
        $link = Link::factory()
                    ->for(User::factory())
                    ->createOne();
        
        $data = $link->toArray();
        $data['label'] = 'New label';

        $response = $this->putJson('/api/link/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_link_by_id(): void
    {
        $link = Link::factory()
                    ->for(User::factory())
                    ->createOne();

        $response = $this->deleteJson('/api/link/'.$link->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_link_by_invalid_id(): void
    {
        $response = $this->deleteJson('/api/link/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
