<?php

namespace Tests\Feature;

use App\Models\Testimonial;
use App\Models\User;
use Tests\TestCase;

class TestimonialTest extends TestCase
{
    public function test_can_list_testimonials(): void
    {
        Testimonial::factory()
                    ->count(3)
                    ->for(User::factory())
                    ->create();
        $response = $this->getJson('/api/testimonial');

        $response->assertStatus(200)
            ->assertJsonIsArray()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'user_id',
                    'name',
                    'sex',
                    'date',
                    'testimonial',
                    'original_url',
                    'updated_at',
                    'created_at'
                ]
            ])
            ->assertJsonCount(3);
    }

    public function test_can_get_testimonial_by_id(): void
    {
        $testimonial = Testimonial::factory()
                                    ->for(User::factory())
                                    ->createOne();

        $response = $this->getJson('/api/testimonial/'.$testimonial->id);

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'user_id',
                'name',
                'sex',
                'date',
                'testimonial',
                'original_url',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $testimonial->name]);
    }

    public function test_cannot_get_testimonial_by_invalid_id(): void
    {
        $response = $this->getJson('/api/testimonial/999999');

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_testimonial(): void
    {
        $testimonial = Testimonial::factory()->makeOne();
        $user = User::factory()->createOne();
        $testimonial->user_id = $user->id;
        $data = $testimonial->toArray();

        $response = $this->postJson('/api/testimonial/', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'user_id',
                'name',
                'sex',
                'date',
                'testimonial',
                'original_url',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $testimonial->name]);
    }

    public function test_can_update_testimonial(): void
    {
        $testimonial = Testimonial::factory()
                                ->for(User::factory())
                                ->createOne();
        $data = $testimonial->toArray();
        $data['name'] = 'New name';

        $response = $this->putJson('/api/testimonial/'.$testimonial->id, $data,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'user_id',
                'name',
                'sex',
                'date',
                'testimonial',
                'original_url',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => 'New name']);
    }

    public function test_cannot_update_testimonial_with_invalid_id(): void
    {
        $testimonial = Testimonial::factory()
                                ->for(User::factory())
                                ->createOne();
        
        $data = $testimonial->toArray();
        $data['name'] = 'New name';

        $response = $this->putJson('/api/testimonial/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_testimonial_by_id(): void
    {
        $testimonial = Testimonial::factory()
                                ->for(User::factory())
                                ->createOne();

        $response = $this->deleteJson('/api/testimonial/'.$testimonial->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_testimonial_by_invalid_id(): void
    {
        $response = $this->deleteJson('/api/testimonial/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
