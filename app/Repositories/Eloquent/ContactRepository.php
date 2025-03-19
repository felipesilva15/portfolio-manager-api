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
}