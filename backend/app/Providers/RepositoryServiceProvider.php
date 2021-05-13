<?php

namespace App\Providers;

use App\Domains\Repositories\ArticleRepository;
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
    }

    /**
     * Bootstrap services
     */
    public function boot()
    {
    }
}
