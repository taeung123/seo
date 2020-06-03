<?php

namespace VCComponent\Laravel\SEO\Test\Stubs\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use VCComponent\Laravel\SEO\Test\Stubs\Entities\Test;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'tests' => Test::class,
        ]);
    }

    /**
     * Register any package services
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
