<?php

namespace App\Repositories\Eloquent;

use App\Models\Contact;
use App\Models\Tag;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Illuminate\Support\Collection;

class ContactRepository implements ContactRepositoryInterface {
    public function getAll(): Collection {
        return Tag::all();
    }

    public function getById(int $id): ?Contact {
        return Contact::find($id);
    }

    public function create(array $data): Contact {
        return Contact::create($data);
    }

    public function update(int $id, array $data): ?Contact {
        $contact = $this->getById($id);

        if (!$contact) {
            return null;
        }

        $contact->update($data);

        return $contact;
    }

    public function deleteById(int $id): bool {
        $contact = $this->getById($id);

        if (!$contact) {
            return false;
        }

        $contact->delete();

        return true;
    }
}