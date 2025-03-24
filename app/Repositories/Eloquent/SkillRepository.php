<?php

namespace App\Repositories\Eloquent;

use App\Models\Skill;
use App\Repositories\Interfaces\SkillRepositoryInterface;
use Illuminate\Support\Collection;

class SkillRepository implements SkillRepositoryInterface {
    public function getAll(): Collection {
        return Skill::all();
    }

    public function getById(int $id): ?Skill {
        return Skill::find($id);
    }

    public function create(array $data): Skill {
        return Skill::create($data);
    }

    public function update(int $id, array $data): ?Skill {
        $skill = $this->getById($id);

        if (!$skill) {
            return null;
        }

        $skill->update($data);

        return $skill;
    }

    public function deleteById(int $id): bool {
        $skill = $this->getById($id);

        if (!$skill) {
            return false;
        }

        $skill->delete();

        return true;
    }
}