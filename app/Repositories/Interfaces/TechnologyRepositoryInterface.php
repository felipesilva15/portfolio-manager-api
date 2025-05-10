<?php

namespace App\Repositories\Interfaces;

use App\Models\Technology;
use Illuminate\Support\Collection;

interface TechnologyRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Technology;
    public function create(array $data): Technology;
    public function update(int $id, array $data): ?Technology;
    public function deleteById(int $id): bool;
}