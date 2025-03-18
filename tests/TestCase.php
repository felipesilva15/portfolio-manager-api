<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected string $authToken;
    protected User $authUser;

    protected function setUp(): void {
        parent::setUp();

        $this->generateAndSetAuthData();
    }

    protected function generateAndSetAuthData(): void {
        $this->authUser = User::factory()->create();
        $this->authToken = JWTAuth::fromUser($this->authUser);
    }

    protected function getAuthHeaders() : array {
        return [
            "Authorization" => "Bearer {$this->authToken}"
        ];
    }
}
