<?php

namespace App\Repositories\Interfaces;

use App\Models\Education;
use Illuminate\Support\Collection;

interface EducationRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Education;
    public function create(array $data): Education;
    public function update(int $id, array $data): ?Education;
    public function deleteById(int $id): bool;
}