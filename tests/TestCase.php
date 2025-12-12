<?php

declare(strict_types=1);

namespace Tests;

use Revolution\Salvager\Providers\SalvagerServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            SalvagerServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            //
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('salvager.screenshots', __DIR__.'/../examples/screenshots/');
        $app['config']->set('salvager.console', __DIR__.'/../examples/console/');
    }
}
