<?php

namespace App\Repositories\Interfaces;

use App\Models\ProjectType;
use Illuminate\Support\Collection;

interface ProjectTypeRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?ProjectType;
    public function create(array $data): ProjectType;
    public function update(int $id, array $data): ?ProjectType;
    public function deleteById(int $id): bool;
}