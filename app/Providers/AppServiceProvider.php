<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Stage;
use App\Models\User;
use App\Repository\ProjectRepository;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\StageRepository;
use App\Repository\StageRepositoryInterface;
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
            fn () => new UserRepository(new User));

        $this->app->singleton(ProjectRepositoryInterface::class,
            fn () => new ProjectRepository(new Project));

        $this->app->singleton(StageRepositoryInterface::class,
            fn () => new StageRepository(new Stage));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
