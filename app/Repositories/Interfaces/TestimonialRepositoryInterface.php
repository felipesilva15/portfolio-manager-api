<?php

namespace App\Repositories\Interfaces;

use App\Models\Testimonial;
use Illuminate\Support\Collection;

interface TestimonialRepositoryInterface {
    public function getAll(): Collection;
    public function getById(int $id): ?Testimonial;
    public function create(array $data): Testimonial;
    public function update(int $id, array $data): ?Testimonial;
    public function deleteById(int $id): bool;
}