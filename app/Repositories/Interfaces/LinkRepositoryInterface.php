<?php

namespace App\Repositories\Interfaces;

use App\Models\Link;
use Illuminate\Support\Collection;

interface LinkRepositoryInterface {
    public function getAll(): Collection;
    public function getById(int $id): ?Link;
    public function create(array $data): Link;
    public function update(int $id, array $data): ?Link;
    public function deleteById(int $id): bool;
}