<?php

namespace PatrickRiemer\HttpLog;

use Illuminate\Support\ServiceProvider;

class HttpLogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'httplog');
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('httplog.php'),
            ], 'config');

        }
    }
}