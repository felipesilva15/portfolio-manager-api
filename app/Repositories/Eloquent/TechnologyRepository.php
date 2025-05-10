<?php

namespace App\Repositories\Eloquent;

use App\Models\Technology;
use App\Repositories\Interfaces\TechnologyRepositoryInterface;
use Illuminate\Support\Collection;

class TechnologyRepository implements TechnologyRepositoryInterface {
    public function getAll(): Collection {
        return Technology::all();
    }

    public function getById(int $id): ?Technology {
        return Technology::find($id);
    }

    public function create(array $data): Technology {
        return Technology::create($data);
    }

    public function update(int $id, array $data): ?Technology {
        $technology = $this->getById($id);

        if (!$technology) {
            return null;
        }

        $technology->update($data);

        return $technology;
    }

    public function deleteById(int $id): bool {
        $technology = $this->getById($id);

        if (!$technology) {
            return false;
        }

        $technology->delete();

        return true;
    }
}