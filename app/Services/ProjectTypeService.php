<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Models\ProjectType;
use App\Repositories\Interfaces\ProjectTypeRepositoryInterface;
use Illuminate\Support\Collection;

class ProjectTypeService {
    protected ProjectTypeRepositoryInterface $projectTypeRepository;

    public function __construct(ProjectTypeRepositoryInterface $projectTypeRepository) {
        $this->projectTypeRepository = $projectTypeRepository;
    }

    public function getAll(): Collection {
        return $this->projectTypeRepository->getAll();
    }

    public function getById(int $id): ProjectType {
        $projectType = $this->projectTypeRepository->getById($id);

        if (!$projectType) {
            throw new NotFoundHttpException();
        }

        return $projectType;
    }

    public function create(array $data): ProjectType {
        return $this->projectTypeRepository->create($data);
    }

    public function update(int $id, array $data): ProjectType {
        $projectType = $this->projectTypeRepository->update($id, $data);

        if (!$projectType) {
            throw new NotFoundHttpException();
        }

        return $projectType;
    }

    public function deleteById(int $id): void {
        $success = $this->projectTypeRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }
}