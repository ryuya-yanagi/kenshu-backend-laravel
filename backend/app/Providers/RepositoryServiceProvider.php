<?php

namespace App\Providers;

use App\Domains\Repositories\ArticleRepository;
use App\Domains\Repositories\AuthRepository;
use App\Domains\Repositories\PhotoRepository;
use App\Domains\Repositories\TagRepository;
use App\Domains\Repositories\UserRepository;
use App\Infrastructure\RepositoryImpl\Eloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services
     */
    public function register()
    {
        $this->app->bind(
            UserRepository::class,
            Eloquent\UserRepositoryImpl::class
        );

        $this->app->bind(
            ArticleRepository::class,
            Eloquent\ArticleRepositoryImpl::class
        );

        $this->app->bind(
            AuthRepository::class,
            Eloquent\AuthRepositoryImpl::class
        );

        $this->app->bind(
            PhotoRepository::class,
            Eloquent\PhotoRepositoryImpl::class
        );

        $this->app->bind(
            TagRepository::class,
            Eloquent\TagRepositoryImpl::class
        );
    }

    /**
     * Bootstrap services
     */
    public function boot()
    {
    }
}
