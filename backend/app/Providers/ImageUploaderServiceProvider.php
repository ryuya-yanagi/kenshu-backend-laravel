<?php

namespace App\Providers;

use App\Domains\Uploaders\ImageUploader;
use App\Infrastructure\UploaderImpl\Local;
use Illuminate\Support\ServiceProvider;

class ImageUploaderServiceProvider extends ServiceProvider
{
    /**
     * Register services
     */
    public function register()
    {
        $this->app->bind(
            ImageUploader::class,
            Local\ImageUploaderImpl::class
        );
    }

    /**
     * Bootstrap services
     */
    public function boot()
    {
    }
}
