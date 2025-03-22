<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Models\Experience;
use App\Repositories\Interfaces\ExperienceRepositoryInterface;
use Illuminate\Support\Collection;

class ExperienceService {
    protected ExperienceRepositoryInterface $experienceRepository;

    public function __construct(ExperienceRepositoryInterface $experienceRepository) {
        $this->experienceRepository = $experienceRepository;
    }

    public function getAll(): Collection {
        return $this->experienceRepository->getAll();
    }

    public function getById(int $id): Experience {
        $experience = $this->experienceRepository->getById($id);

        if (!$experience) {
            throw new NotFoundHttpException();
        }

        return $experience;
    }

    public function create(array $data): Experience {
        return $this->experienceRepository->create($data);
    }

    public function update(int $id, array $data): Experience {
        $experience = $this->experienceRepository->update($id, $data);

        if (!$experience) {
            throw new NotFoundHttpException();
        }

        return $experience;
    }

    public function deleteById(int $id): void {
        $success = $this->experienceRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }
}