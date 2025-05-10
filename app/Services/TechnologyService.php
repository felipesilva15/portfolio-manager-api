<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Models\Technology;
use App\Repositories\Interfaces\TechnologyRepositoryInterface;
use Illuminate\Support\Collection;

class TechnologyService {
    protected TechnologyRepositoryInterface $technologyRepository;

    public function __construct(TechnologyRepositoryInterface $technologyRepository) {
        $this->technologyRepository = $technologyRepository;
    }

    public function getAll(): Collection {
        return $this->technologyRepository->getAll();
    }

    public function getById(int $id): Technology {
        $technology = $this->technologyRepository->getById($id);

        if (!$technology) {
            throw new NotFoundHttpException();
        }

        return $technology;
    }

    public function create(array $data): Technology {
        return $this->technologyRepository->create($data);
    }

    public function update(int $id, array $data): Technology {
        $technology = $this->technologyRepository->update($id, $data);

        if (!$technology) {
            throw new NotFoundHttpException();
        }

        return $technology;
    }

    public function deleteById(int $id): void {
        $success = $this->technologyRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }
}