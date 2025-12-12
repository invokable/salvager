<?php

declare(strict_types=1);

namespace Revolution\Salvager\Providers;

use Illuminate\Support\ServiceProvider;
use PlaywrightPhp\Playwright;
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

        $this->app->singleton(Factory::class, Client::class);

        $this->app->singleton(Playwright::class, fn () => new Playwright(config('salvager.playwright')));
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
