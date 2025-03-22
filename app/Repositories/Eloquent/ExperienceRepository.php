<?php

namespace App\Repositories\Eloquent;

use App\Models\Experience;
use App\Models\Tag;
use App\Repositories\Interfaces\ExperienceRepositoryInterface;
use Illuminate\Support\Collection;

class ExperienceRepository implements ExperienceRepositoryInterface {
    public function getAll(): Collection {
        return Tag::all();
    }

    public function getById(int $id): ?Experience {
        return Experience::find($id);
    }

    public function create(array $data): Experience {
        return Experience::create($data);
    }

    public function update(int $id, array $data): ?Experience {
        $experience = $this->getById($id);

        if (!$experience) {
            return null;
        }

        $experience->update($data);

        return $experience;
    }

    public function deleteById(int $id): bool {
        $experience = $this->getById($id);

        if (!$experience) {
            return false;
        }

        $experience->delete();

        return true;
    }
}