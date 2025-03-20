<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface {
    public function getAll(): Collection {
        return User::all();
    }

    public function getById(int $id): ?User {
        return User::find($id);
    }

    public function create(array $data): User {
        return User::create($data);
    }
    public function update(int $id, array $data): ?User {
        $user = $this->getById($id);

        if (!$user) {
            return null;
        }

        $user->update($data);

        return $user;
    }

    public function deleteById(int $id): bool {
        $user = $this->getById($id);

        if (!$user) {
            return false;
        }

        $user->delete($id);

        return true;
    }
}