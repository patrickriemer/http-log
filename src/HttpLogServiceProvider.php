<?php

namespace PatrickRiemer\HttpLog;

use Illuminate\Support\ServiceProvider;

class HttpLogServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}