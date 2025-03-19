<?php

namespace Tests\Feature;

use App\Models\Contact;
use Tests\TestCase;

class ContactTest extends TestCase
{
    public function test_can_list_contacts(): void
    {
        Contact::factory(3)->create();
        $response = $this->getJson('/api/contact', $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsArray()
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'email',
                    'subject',
                    'message',
                    'status',
                    'updated_at',
                    'created_at'
                ]
            ]);
    }

    public function test_can_get_contact_by_id(): void
    {
        $contact = Contact::factory()->createOne();

        $response = $this->getJson('/api/contact/'.$contact->id,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'subject',
                'message',
                'status',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $contact->name]);
    }

    public function test_cannot_get_contact_by_invalid_id(): void
    {
        $response = $this->getJson('/api/contact/999999',  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_create_contact(): void
    {
        $contact = Contact::factory()->makeOne();
        $data = $contact->toArray();

        $response = $this->postJson('/api/contact/', $data, $this->getAuthHeaders());

        $response->assertStatus(201)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'subject',
                'message',
                'status',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => $contact->name]);
    }

    public function test_can_update_contact(): void
    {
        $contact = Contact::factory()->createOne();
        
        $data = $contact->toArray();
        $data['name'] = 'New name';

        $response = $this->putJson('/api/contact/'.$contact->id, $data,  $this->getAuthHeaders());

        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'subject',
                'message',
                'status',
                'updated_at',
                'created_at'
            ])
            ->assertJsonFragment(['name' => 'New name']);
    }

    public function test_cannot_update_contact_with_invalid_id(): void
    {
        $contact = Contact::factory()->createOne();
        
        $data = $contact->toArray();
        $data['name'] = 'New name';

        $response = $this->putJson('/api/contact/999999', $data,  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }

    public function test_can_delete_contact_by_id(): void
    {
        $contact = Contact::factory()->createOne();

        $response = $this->deleteJson('/api/contact/'.$contact->id, [],  $this->getAuthHeaders());

        $response->assertNoContent();
    }

    public function test_cannot_delete_contact_by_invalid_id(): void
    {
        $response = $this->deleteJson('/api/contact/999999', [],  $this->getAuthHeaders());

        $response->assertNotFound()
                    ->assertJsonStructure([
                        'path',
                        'code',
                        'message'
                    ]);
    }
}
