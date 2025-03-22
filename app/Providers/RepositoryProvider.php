<?php

namespace App\Providers;

use App\Repositories\Eloquent\CertificationRepository;
use App\Repositories\Eloquent\ContactRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\CertificationRepositoryInterface;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(CertificationRepositoryInterface::class, CertificationRepository::class);
    }
}
