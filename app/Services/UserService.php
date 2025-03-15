<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserService {
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAll(): Collection {
        return $this->userRepository->getAll();
    }

    public function getById($id): User {
        $user = $this->userRepository->getById($id);

        if (!$user) {
            throw new NotFoundHttpException();
        }

        return $user;
    }

    public function create(array $data): User {
        return $this->userRepository->create($data);
    }

    public function update(int $id, array $data): User {
        $user = $this->userRepository->update($id, $data);

        if (!$user) {
            throw new NotFoundHttpException();
        }

        return $user;
    }

    public function deleteById(int $id): void {
        $success = $this->userRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }
}