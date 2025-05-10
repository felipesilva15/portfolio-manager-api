<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Helpers\ArrayUtils;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use Illuminate\Support\Collection;

class ProjectService {
    protected ProjectRepositoryInterface $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository) {
        $this->projectRepository = $projectRepository;
    }

    public function getAll(): Collection {
        return $this->projectRepository->getAll();
    }

    public function getById(int $id): Project {
        $project = $this->projectRepository->getById($id);

        if (!$project) {
            throw new NotFoundHttpException();
        }

        return $project;
    }

    public function create(array $data): Project {
        $project = $this->projectRepository->create($data);

        if (isset($data['tags']) && count($data['tags']) > 0) {
            $project = $this->syncTags($project, $data['tags']);
        }

        if (isset($data['technologies']) && count($data['technologies']) > 0) {
            $project = $this->syncTechnologies($project, $data['technologies']);
        }

        return $project;
    }

    public function update(int $id, array $data): Project {
        $project = $this->projectRepository->update($id, $data);

        if (!$project) {
            throw new NotFoundHttpException();
        }

        if (isset($data['tags']) && count($data['tags']) > 0) {
            $project = $this->syncTags($project, $data['tags']);
        }

        if (isset($data['technologies']) && count($data['technologies']) > 0) {
            $project = $this->syncTechnologies($project, $data['technologies']);
        }

        return $project;
    }

    public function deleteById(int $id): void {
        $success = $this->projectRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }

    public function syncTags(Project $project, array $tags): Project {
        $tagIds = ArrayUtils::getArrayOfAnArrayProperty($tags, 'id');
        $project = $this->projectRepository->syncTags($project, $tagIds);

        return $project;
    }

    public function getTagsByProjectId(int $id): Collection {
        $tags = $this->projectRepository->getTagsByProjectId($id);

        if (!$tags) {
            throw new NotFoundHttpException();
        }

        return $tags;
    }

    public function syncTechnologies(Project $project, array $technologies): Project {
        $technologiesIds = ArrayUtils::getArrayOfAnArrayProperty($technologies, 'id');
        $project = $this->projectRepository->syncTechnologies($project, $technologiesIds);

        return $project;
    }
}