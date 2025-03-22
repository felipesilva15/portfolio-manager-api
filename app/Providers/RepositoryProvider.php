<?php

namespace App\Providers;

use App\Repositories\Eloquent\CertificationRepository;
use App\Repositories\Eloquent\ContactRepository;
use App\Repositories\Eloquent\EducationRepository;
use App\Repositories\Eloquent\ExperienceRepository;
use App\Repositories\Eloquent\SkillRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\CertificationRepositoryInterface;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use App\Repositories\Interfaces\EducationRepositoryInterface;
use App\Repositories\Interfaces\ExperienceRepositoryInterface;
use App\Repositories\Interfaces\SkillRepositoryInterface;
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
        $this->app->bind(EducationRepositoryInterface::class, EducationRepository::class);
        $this->app->bind(ExperienceRepositoryInterface::class, ExperienceRepository::class);
        $this->app->bind(SkillRepositoryInterface::class, SkillRepository::class);
    }
}
