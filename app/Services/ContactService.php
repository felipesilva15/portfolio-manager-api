<?php

namespace App\Services;

use App\Exceptions\BussinessRuleException;
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
        if ($this->existsPendingContact($data)) {
            throw new BussinessRuleException("Já existe um contato pendente com este e-mail.");
        }

        return $this->contactRepository->create($data);
    }

    public function update(int $id, array $data): Contact {
        if ($this->existsPendingContact($data, $id)) {
            throw new BussinessRuleException("Já existe um contato pendente com este e-mail.");
        }

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

    public function existsPendingContact(array $contact, int $id = 0): bool {
        $pendingContact = $this->contactRepository->getPendingContactByEmail($contact['email']);

        if (!$pendingContact) {
            return false;
        }

        if ($pendingContact->id == $id) {
            return false;
        }

        return true;
    }
}