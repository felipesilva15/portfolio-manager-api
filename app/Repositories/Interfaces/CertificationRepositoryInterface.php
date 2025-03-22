<?php

namespace App\Repositories\Interfaces;

use App\Models\Certification;
use Illuminate\Support\Collection;

interface CertificationRepositoryInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Certification;
    public function create(array $data): Certification;
    public function update(int $id, array $data): ?Certification;
    public function deleteById(int $id): bool;
}