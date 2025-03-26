<?php

namespace App\Repositories\Eloquent;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Support\Collection;

class ProjectRepository implements ProjectRepositoryInterface {
    public function getAll(): Collection {
        return Project::all();
    }

    public function getById(int $id): ?Project {
        return Project::find($id);
    }

    public function create(array $data): Project {
        return Project::create($data);
    }

    public function update(int $id, array $data): ?Project {
        $project = $this->getById($id);

        if (!$project) {
            return null;
        }

        $project->update($data);

        return $project;
    }

    public function deleteById(int $id): bool {
        $project = $this->getById($id);

        if (!$project) {
            return false;
        }

        $project->delete();

        return true;
    }

    public function syncTags(Project $project, array $tagIds): Project {
        $project->tags()->sync($tagIds);
        $project->load(['tags']);

        return $project;
    }

    public function getTagsByProjectId(int $id): ?Collection {
        $project = $this->getById($id);

        if (!$project) {
            return null;
        }

        return $project->tags;
    }
}