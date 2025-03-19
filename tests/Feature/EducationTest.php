<?php

namespace Tests\Feature;

use App\Models\Education;
use Tests\TestCase;

class EducationTest extends TestCase
{
    public function test_can_list_educations(): void
    {
        Education::factory(3)->create();
        $response = $this->getJson('/api/education', $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsArray()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'institution_name',
                    'degree',
                    'locality',
                    'start_date',
                    'end_date',
                    'updated_at',
                    'created_at'
                ]
            ]);
    }

    public function test_can_get_education_by_id(): void
    {
        $education = Education::factory()->createOne();

        $response = $this->getJson('/api/education/'.$education->id,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'institution_name',
                'degree',
                'locality',
                'start_date',
                'end_date',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['degree' => $education->degree]);
    }

    public function test_cannot_get_education_by_invalid_id(): void
    {
        $response = $this->getJson('/api/education/999999',  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_education(): void
    {
        $education = Education::factory()->makeOne();
        $data = $education->toArray();

        $response = $this->postJson('/api/education/', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'institution_name',
                'degree',
                'locality',
                'start_date',
                'end_date',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['degree' => $education->degree]);
    }

    public function test_can_update_education(): void
    {
        $education = Education::factory()->createOne();
        
        $data = $education->toArray();
        $data['degree'] = 'New degree';

        $response = $this->putJson('/api/education/'.$education->id, $data,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'institution_name',
                'degree',
                'locality',
                'start_date',
                'end_date',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['degree' => 'New degree']);
    }

    public function test_cannot_update_education_with_invalid_id(): void
    {
        $education = Education::factory()->createOne();
        
        $data = $education->toArray();
        $data['degree'] = 'New degree';

        $response = $this->putJson('/api/education/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_education_by_id(): void
    {
        $education = Education::factory()->createOne();

        $response = $this->deleteJson('/api/education/'.$education->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_education_by_invalid_id(): void
    {
        $response = $this->deleteJson('/api/education/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
