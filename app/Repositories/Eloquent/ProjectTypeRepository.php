<?php

namespace App\Repositories\Eloquent;

use App\Models\ProjectType;
use App\Repositories\Interfaces\ProjectTypeRepositoryInterface;
use Illuminate\Support\Collection;

class ProjectTypeRepository implements ProjectTypeRepositoryInterface {
    public function getAll(): Collection {
        return ProjectType::all();
    }

    public function getById(int $id): ?ProjectType {
        return ProjectType::find($id);
    }

    public function create(array $data): ProjectType {
        return ProjectType::create($data);
    }

    public function update(int $id, array $data): ?ProjectType {
        $projectType = $this->getById($id);

        if (!$projectType) {
            return null;
        }

        $projectType->update($data);

        return $projectType;
    }

    public function deleteById(int $id): bool {
        $projectType = $this->getById($id);

        if (!$projectType) {
            return false;
        }

        $projectType->delete();

        return true;
    }
}