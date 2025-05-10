<?php

namespace App\Repositories\Interfaces;

use App\Models\Project;
use Illuminate\Support\Collection;

interface ProjectRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Project;
    public function create(array $data): Project;
    public function update(int $id, array $data): ?Project;
    public function deleteById(int $id): bool;
    public function syncTags(Project $project, array $tagIds): Project;
    public function getTagsByProjectId(int $id): ?Collection;
    public function syncTechnologies(Project $project, array $technologyIds): Project;
}