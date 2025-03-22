<?php

namespace App\Services;

use App\Exceptions\NotFoundHttpException;
use App\Models\Certification;
use App\Repositories\Interfaces\CertificationRepositoryInterface;
use Illuminate\Support\Collection;

class CertificationService {
    protected CertificationRepositoryInterface $certificationRepository;

    public function __construct(CertificationRepositoryInterface $certificationRepository) {
        $this->certificationRepository = $certificationRepository;
    }

    public function getAll(): Collection {
        return $this->certificationRepository->getAll();
    }

    public function getById(int $id): Certification {
        $certification = $this->certificationRepository->getById($id);

        if (!$certification) {
            throw new NotFoundHttpException();
        }

        return $certification;
    }

    public function create(array $data): Certification {
        return $this->certificationRepository->create($data);
    }

    public function update(int $id, array $data): Certification {
        $certification = $this->certificationRepository->update($id, $data);

        if (!$certification) {
            throw new NotFoundHttpException();
        }

        return $certification;
    }

    public function deleteById(int $id): void {
        $success = $this->certificationRepository->deleteById($id);

        if (!$success) {
            throw new NotFoundHttpException();
        }
    }
}