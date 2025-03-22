<?php

namespace App\Repositories\Eloquent;

use App\Models\Education;
use App\Models\Tag;
use App\Repositories\Interfaces\EducationRepositoryInterface;
use Illuminate\Support\Collection;

class EducationRepository implements EducationRepositoryInterface {
    public function getAll(): Collection {
        return Tag::all();
    }

    public function getById(int $id): ?Education {
        return Education::find($id);
    }

    public function create(array $data): Education {
        return Education::create($data);
    }

    public function update(int $id, array $data): ?Education {
        $education = $this->getById($id);

        if (!$education) {
            return null;
        }

        $education->update($data);

        return $education;
    }

    public function deleteById(int $id): bool {
        $education = $this->getById($id);

        if (!$education) {
            return false;
        }

        $education->delete();

        return true;
    }
}