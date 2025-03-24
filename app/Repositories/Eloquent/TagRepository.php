<?php

namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Support\Collection;

class TagRepository implements TagRepositoryInterface {
    public function getAll(): Collection {
        return Tag::all();
    }

    public function getById(int $id): ?Tag {
        return Tag::find($id);
    }

    public function create(array $data): Tag {
        return Tag::create($data);
    }

    public function update(int $id, array $data): ?Tag {
        $tag = $this->getById($id);

        if (!$tag) {
            return null;
        }

        $tag->update($data);

        return $tag;
    }

    public function deleteById(int $id): bool {
        $tag = $this->getById($id);

        if (!$tag) {
            return false;
        }

        $tag->delete();

        return true;
    }

    public function getProjectByTagId(int $id): ?Collection {
        $tag = $this->getById($id);

        if (!$tag) {
            return null;
        }

        return $tag->projects;
    }
}