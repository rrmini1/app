<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\User;
use App\Repository\ProjectRepository;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryInterface::class,
            fn() => new UserRepository(new User));

        $this->app->singleton(ProjectRepositoryInterface::class,
            fn() => new ProjectRepository(new Project));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
