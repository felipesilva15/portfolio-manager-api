<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Models\Education;
use App\Repositories\Interfaces\EducationRepositoryInterface;
use Illuminate\Support\Collection;

class EducationService {
    protected EducationRepositoryInterface $educationRepository;

    public function __construct(EducationRepositoryInterface $educationRepository) {
        $this->educationRepository = $educationRepository;
    }

    public function getAll(): Collection {
        return $this->educationRepository->getAll();
    }

    public function getById(int $id): Education {
        $education = $this->educationRepository->getById($id);

        if (!$education) {
            throw new NotFoundHttpException();
        }

        return $education;
    }

    public function create(array $data): Education {
        return $this->educationRepository->create($data);
    }

    public function update(int $id, array $data): Education {
        $education = $this->educationRepository->update($id, $data);

        if (!$education) {
            throw new NotFoundHttpException();
        }

        return $education;
    }

    public function deleteById(int $id): void {
        $success = $this->educationRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }
}