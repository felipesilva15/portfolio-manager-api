<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface UserRepositoryInterface {
    public function getAll(): Collection;
}