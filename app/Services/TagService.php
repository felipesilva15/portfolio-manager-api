<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Support\Collection;

class TagService {
    protected TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository) {
        $this->tagRepository = $tagRepository;
    }

    public function getAll(): Collection {
        return $this->tagRepository->getAll();
    }

    public function getById(int $id): Tag {
        $tag = $this->tagRepository->getById($id);

        if (!$tag) {
            throw new NotFoundHttpException();
        }

        return $tag;
    }

    public function create(array $data): Tag {
        return $this->tagRepository->create($data);
    }

    public function update(int $id, array $data): Tag {
        $tag = $this->tagRepository->update($id, $data);

        if (!$tag) {
            throw new NotFoundHttpException();
        }

        return $tag;
    }

    public function deleteById(int $id): void {
        $success = $this->tagRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }

    public function getProjectsByTagId(int $id): Collection {
        $projects = $this->tagRepository->getProjectByTagId($id);

        if (!$projects) {
            throw new NotFoundHttpException();
        }

        return $projects;
    }
}