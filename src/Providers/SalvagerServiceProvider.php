<?php

declare(strict_types=1);

namespace Revolution\Salvager\Providers;

use Illuminate\Support\ServiceProvider;
use Revolution\Salvager\Client;
use Revolution\Salvager\Contracts\Factory;

class SalvagerServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/salvager.php', 'salvager');

        $this->app->scoped(Factory::class, Client::class);
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/salvager.php' => config_path('salvager.php'),
        ], 'salvager-config');
    }
}
