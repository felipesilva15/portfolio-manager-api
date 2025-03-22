<?php

namespace App\Repositories\Eloquent;

use App\Models\Certification;
use App\Models\Tag;
use App\Repositories\Interfaces\CertificationRepositoryInterface;
use Illuminate\Support\Collection;

class CertificationRepository implements CertificationRepositoryInterface {
    public function getAll(): Collection {
        return Tag::all();
    }

    public function getById(int $id): ?Certification {
        return Certification::find($id);
    }

    public function create(array $data): Certification {
        return Certification::create($data);
    }

    public function update(int $id, array $data): ?Certification {
        $certification = $this->getById($id);

        if (!$certification) {
            return null;
        }

        $certification->update($data);

        return $certification;
    }

    public function deleteById(int $id): bool {
        $certification = $this->getById($id);

        if (!$certification) {
            return false;
        }

        $certification->delete();

        return true;
    }
}