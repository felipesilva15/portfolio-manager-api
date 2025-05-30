<?php

namespace App\Repositories\Eloquent;

use App\Models\Testimonial;
use App\Repositories\Interfaces\TestimonialRepositoryInterface;
use Illuminate\Support\Collection;

class TestimonialRepository implements TestimonialRepositoryInterface {
    public function getAll(): Collection {
        return Testimonial::all();
    }

    public function getById(int $id): ?Testimonial {
        return Testimonial::find($id);
    }

    public function create(array $data): Testimonial {
        return Testimonial::create($data);
    }

    public function update(int $id, array $data): ?Testimonial {
        $testimonial = $this->getById($id);

        if (!$testimonial) {
            return null;
        }

        $testimonial->update($data);

        return $testimonial;
    }

    public function deleteById(int $id): bool {
        $testimonial = $this->getById($id);

        if (!$testimonial) {
            return false;
        }

        $testimonial->delete();

        return true;
    }
}