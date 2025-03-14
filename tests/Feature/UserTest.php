<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_can_list_users(): void
    {
        $response = $this->getJson('/api/user');

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
}
