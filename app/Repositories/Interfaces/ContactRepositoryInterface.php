<?php

namespace App\Repositories\Interfaces;

use App\Models\Contact;
use Illuminate\Support\Collection;

interface ContactRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Contact;
    public function create(array $data): Contact;
    public function update(int $id, array $data): ?Contact;
    public function deleteById(int $id): bool;
    public function getPendingContactByEmail(string $email);
}