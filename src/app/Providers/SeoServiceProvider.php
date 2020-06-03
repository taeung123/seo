<?php

namespace VCComponent\Laravel\SEO\Providers;

use Illuminate\Support\ServiceProvider;
use VCComponent\Laravel\SEO\Repositories\SeoMetaRepository;
use VCComponent\Laravel\SEO\Repositories\SeoMetaRepositoryEloquent;

class SeoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
    }

    /**
     * Register any package services
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SeoMetaRepository::class, SeoMetaRepositoryEloquent::class);
    }
}
