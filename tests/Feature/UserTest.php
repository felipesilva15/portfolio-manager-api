<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_can_list_users(): void
    {
        $currentUsersCount = User::select('id')->get()->count();
        $usersToGenerate = 3;
        $expectedUsersCount = $currentUsersCount + $usersToGenerate;

        User::factory($usersToGenerate)->create();
        $response = $this->getJson('/api/user', $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsArray()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'email',
                    'updated_at',
                    'created_at'
                ]
            ])
            ->assertJsonCount($expectedUsersCount);
    }

    public function test_can_get_user_by_id(): void
    {
        $user = User::factory()->createOne();

        $response = $this->getJson('/api/user/'.$user->id,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $user->name]);
    }

    public function test_cannot_get_user_by_invalid_id(): void
    {
        $response = $this->getJson('/api/user/999999',  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_user(): void
    {
        $user = User::factory()->makeOne();

        $data = $user->toArray();
        $data['password'] = '123';

        $response = $this->postJson('/api/user/', $data);

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $user->name]);
    }

    public function test_can_update_user(): void
    {
        $user = User::factory()->createOne();
        
        $data = $user->toArray();
        $data['password'] = '123';
        $data['name'] = 'New name';

        $response = $this->putJson('/api/user/'.$user->id, $data,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => 'New name']);
    }

    public function test_cannot_update_user_with_invalid_id(): void
    {
        $user = User::factory()->createOne();
        
        $data = $user->toArray();
        $data['password'] = '123';
        $data['name'] = 'New name';

        $response = $this->putJson('/api/user/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_user_by_id(): void
    {
        $user = User::factory()->createOne();

        $response = $this->deleteJson('/api/user/'.$user->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_user_by_invalid_id(): void
    {
        $user = User::factory()->createOne();

        $response = $this->deleteJson('/api/user/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
