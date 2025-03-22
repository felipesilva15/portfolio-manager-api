<?php

namespace App\Repositories\Interfaces;

use App\Models\Experience;
use Illuminate\Support\Collection;

interface ExperienceRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Experience;
    public function create(array $data): Experience;
    public function update(int $id, array $data): ?Experience;
    public function deleteById(int $id): bool;
}