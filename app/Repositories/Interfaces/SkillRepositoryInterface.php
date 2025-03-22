<?php

namespace App\Repositories\Interfaces;

use App\Models\Skill;
use Illuminate\Support\Collection;

interface SkillRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Skill;
    public function create(array $data): Skill;
    public function update(int $id, array $data): ?Skill;
    public function deleteById(int $id): bool;
}