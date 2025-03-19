<?php

namespace App\Repositories\Interfaces;

use App\Models\Contact;
use Illuminate\Support\Collection;

interface ContactRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Contact;
}