<?php

namespace App\Repositories\Interfaces;

use App\Models\Tag;
use Illuminate\Support\Collection;

interface TagRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Tag;
    public function create(array $data): Tag;
    public function update(int $id, array $data): ?Tag;
    public function deleteById(int $id): bool;
    public function getProjectByTagId(int $id): ?Collection;
}