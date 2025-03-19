<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_can_login(): void
    {
        $user = User::factory()->createOne();
        $data = [
            'email' => $user->email,
            'password' => "123",
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(200)
                ->assertJsonIsObject()
                ->assertJsonStructure([
                    'access_token',
                    'token_type',
                    'expires_in'
                ]);
    }

    public function test_cannot_login_with_invalid_credentials(): void
    {
        $user = User::factory()->createOne();
        $data = [
            'email' => $user->email,
            'password' => "123456",
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertStatus(401)
                ->assertJsonIsObject()
                ->assertJsonStructure([
                    'path',
                    'code',
                    'message'
                ]);
    }

    public function test_can_logout(): void
    {
        $response = $this->postJson('/api/logout', [], $this->getAuthHeaders());

        $response->assertStatus(200)
                ->assertJsonIsObject()
                ->assertJsonStructure([
                    'message'
                ]);
    }

    public function test_can_refresh_token(): void
    {
        $response = $this->postJson('/api/refresh-token', [], $this->getAuthHeaders());

        $response->assertStatus(200)
                ->assertJsonIsObject()
                ->assertJsonStructure([
                    'access_token',
                    'token_type',
                    'expires_in'
                ]);
    }

    public function test_can_get_data_logged_in_user(): void
    {
        $response = $this->getJson('/api/me', $this->getAuthHeaders());

        $response->assertStatus(200)
                ->assertJsonIsObject()
                ->assertJsonStructure([
                    'id',
                    'name',
                    'email',
                    'updated_at',
                    'created_at'
                ])
                ->assertJsonFragment([
                    'id' => $this->authUser->id,
                    'name' => $this->authUser->name,
                    'email' => $this->authUser->email,
                ]);
    }

    public function test_invalid_token_fails(): void
    {
        $headers = [
            'Authorization' => 'Bearer invalid_token'
        ];

        $response = $this->getJson('/api/me', $headers);

        $response->assertStatus(401)
                ->assertJsonIsObject()
                ->assertJsonStructure([
                    'message'
                ]);
    }

    public function test_expired_token_fails(): void
    {
        $user = User::factory()->createOne();
        $data = [
            'email' => $user->email,
            'password' => "123",
        ];

        $response = $this->postJson('/api/login', $data);
        $expiresIn = $response->json('expires_in');
        $token = $response->json('access_token');

        $this->travel($expiresIn)->minutes();

        Auth::forgetUser();

        $response = $this->getJson('/api/me', [
            "Authorization" => "Bearer ".$token
        ]);

        $response->assertStatus(401)
                ->assertJsonIsObject()
                ->assertJsonStructure([
                    'message'
                ]);
    }

    public function test_can_use_valid_token_successful(): void
    {
        $user = User::factory()->createOne();
        $data = [
            'email' => $user->email,
            'password' => "123",
        ];

        $response = $this->postJson('/api/login', $data);
        $token = $response->json('access_token');

        Auth::forgetUser();

        $response = $this->getJson('/api/me', [
            "Authorization" => "Bearer ".$token
        ]);

        $response->assertStatus(200)
                ->assertJsonIsObject();
    }
}
