<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface {
    public function getAll(): Collection;
    public function getById(int $id): ?User;
    public function create(array $data): User;
    public function update(int $id, array $data): ?User;
    public function deleteById(int $id): bool;
}