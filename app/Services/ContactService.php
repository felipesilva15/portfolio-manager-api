<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Models\Contact;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use Illuminate\Support\Collection;

class ContactService {
    protected ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository) {
        $this->contactRepository = $contactRepository;
    }

    public function getAll(): Collection {
        return $this->contactRepository->getAll();
    }

    public function getById(int $id): Contact {
        $contact = $this->contactRepository->getById($id);

        if (!$contact) {
            throw new NotFoundHttpException();
        }

        return $contact;
    }

    public function create(array $data): Contact {
        return $this->contactRepository->create($data);
    }

    public function update(int $id, array $data): Contact {
        $contact = $this->contactRepository->update($id, $data);

        if (!$contact) {
            throw new NotFoundHttpException();
        }

        return $contact;
    }

    public function deleteById(int $id): void {
        $success = $this->contactRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }
}