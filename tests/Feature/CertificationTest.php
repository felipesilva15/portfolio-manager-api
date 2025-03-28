<?php

namespace Tests\Feature;

use App\Models\Certification;
use App\Models\Tag;
use Tests\TestCase;

class CertificationTest extends TestCase
{
    public function test_can_list_certifications(): void
    {
        Certification::factory(3)->create();
        $response = $this->getJson('/api/certification');

        $response->assertStatus(200)
            ->assertJsonIsArray()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'institution_name',
                    'issued_date',
                    'expiration_date',
                    'credential_id',
                    'credential_url',
                    'updated_at',
                    'created_at'
                ]
            ])
            ->assertJsonCount(3);
    }

    public function test_can_get_certification_by_id(): void
    {
        $certification = Certification::factory()->createOne();

        $response = $this->getJson('/api/certification/'.$certification->id);

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'title',
                'institution_name',
                'issued_date',
                'expiration_date',
                'credential_id',
                'credential_url',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['title' => $certification->title]);
    }

    public function test_cannot_get_certification_by_invalid_id(): void
    {
        $response = $this->getJson('/api/certification/999999');

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_certification(): void
    {
        $certification = Certification::factory()->makeOne();
        $data = $certification->toArray();

        $response = $this->postJson('/api/certification/', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'title',
                'institution_name',
                'issued_date',
                'expiration_date',
                'credential_id',
                'credential_url',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['title' => $certification->title]);
    }

    public function test_can_update_certification(): void
    {
        $certification = Certification::factory()->createOne();
        
        $data = $certification->toArray();
        $data['title'] = 'New title';

        $response = $this->putJson('/api/certification/'.$certification->id, $data,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'title',
                'institution_name',
                'issued_date',
                'expiration_date',
                'credential_id',
                'credential_url',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['title' => 'New title']);
    }

    public function test_cannot_update_certification_with_invalid_id(): void
    {
        $certification = Certification::factory()->createOne();
        
        $data = $certification->toArray();
        $data['title'] = 'New title';

        $response = $this->putJson('/api/certification/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_certification_by_id(): void
    {
        $certification = Certification::factory()->createOne();

        $response = $this->deleteJson('/api/certification/'.$certification->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_certification_by_invalid_id(): void
    {
        $response = $this->deleteJson('/api/certification/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
