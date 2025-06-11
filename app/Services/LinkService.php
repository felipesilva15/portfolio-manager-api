<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Models\Link;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use Illuminate\Support\Collection;

class LinkService {
    protected LinkRepositoryInterface $linkRepository;

    public function __construct(LinkRepositoryInterface $linkRepository) {
        $this->linkRepository = $linkRepository;
    }

    public function getAll(): Collection {
        return $this->linkRepository->getAll();
    }

    public function getById(int $id): Link {
        $link = $this->linkRepository->getById($id);

        if (!$link) {
            throw new NotFoundHttpException();
        }

        return $link;
    }

    public function create(array $data): Link {
        return $this->linkRepository->create($data);
    }

    public function update(int $id, array $data): Link {
        $link = $this->linkRepository->update($id, $data);

        if (!$link) {
            throw new NotFoundHttpException();
        }

        return $link;
    }

    public function deleteById(int $id): void {
        $success = $this->linkRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }
}