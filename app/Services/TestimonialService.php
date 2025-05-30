<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Models\Testimonial;
use App\Repositories\Interfaces\TestimonialRepositoryInterface;
use Illuminate\Support\Collection;

class TestimonialService {
    protected TestimonialRepositoryInterface $testimonialRepository;

    public function __construct(TestimonialRepositoryInterface $testimonialRepository) {
        $this->testimonialRepository = $testimonialRepository;
    }

    public function getAll(): Collection {
        return $this->testimonialRepository->getAll();
    }

    public function getById(int $id): Testimonial {
        $testimonial = $this->testimonialRepository->getById($id);

        if (!$testimonial) {
            throw new NotFoundHttpException();
        }

        return $testimonial;
    }

    public function create(array $data): Testimonial {
        return $this->testimonialRepository->create($data);
    }

    public function update(int $id, array $data): Testimonial {
        $testimonial = $this->testimonialRepository->update($id, $data);

        if (!$testimonial) {
            throw new NotFoundHttpException();
        }

        return $testimonial;
    }

    public function deleteById(int $id): void {
        $success = $this->testimonialRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }
}