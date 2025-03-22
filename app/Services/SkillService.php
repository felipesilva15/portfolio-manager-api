<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Models\Skill;
use App\Repositories\Interfaces\SkillRepositoryInterface;
use Illuminate\Support\Collection;

class SkillService {
    protected SkillRepositoryInterface $skillRepository;

    public function __construct(SkillRepositoryInterface $skillRepository) {
        $this->skillRepository = $skillRepository;
    }

    public function getAll(): Collection {
        return $this->skillRepository->getAll();
    }

    public function getById(int $id): Skill {
        $skill = $this->skillRepository->getById($id);

        if (!$skill) {
            throw new NotFoundHttpException();
        }

        return $skill;
    }

    public function create(array $data): Skill {
        return $this->skillRepository->create($data);
    }

    public function update(int $id, array $data): Skill {
        $skill = $this->skillRepository->update($id, $data);

        if (!$skill) {
            throw new NotFoundHttpException();
        }

        return $skill;
    }

    public function deleteById(int $id): void {
        $success = $this->skillRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }
}