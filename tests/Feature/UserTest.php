<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_list_users(): void
    {
        $user = User::factory()->makeOne();
        $user->save();

        $response = $this->actingAs($user)->getJson('/api/user');

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
            ]);
    }

    public function test_can_get_user_by_id(): void
    {
        $user = User::factory()->makeOne();
        $user->save();

        $response = $this->actingAs($user)->getJson('/api/user/'.$user->id);

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
        $user = User::factory()->makeOne();
        $user->save();

        $data = $user->toArray();
        $data['password'] = '123';
        $data['name'] = 'New name';

        $response = $this->actingAs($user)->putJson('/api/user/'.$user->id, $data);

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

    public function test_can_delete_user_by_id(): void
    {
        $user = User::factory()->makeOne();
        $user->save();

        $response = $this->actingAs($user)->delete('/api/user/'.$user->id);

        $response->assertNoContent();
    }
}
