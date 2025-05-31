<?php

namespace App\Repositories\Eloquent;

use App\Models\Link;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use Illuminate\Support\Collection;

class LinkRepository implements LinkRepositoryInterface {
    public function getAll(): Collection {
        return Link::all();
    }

    public function getById(int $id): ?Link {
        return Link::find($id);
    }

    public function create(array $data): Link {
        return Link::create($data);
    }

    public function update(int $id, array $data): ?Link {
        $link = $this->getById($id);

        if (!$link) {
            return null;
        }

        $link->update($data);

        return $link;
    }

    public function deleteById(int $id): bool {
        $link = $this->getById($id);

        if (!$link) {
            return false;
        }

        $link->delete();

        return true;
    }
}