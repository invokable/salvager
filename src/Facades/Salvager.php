<?php

declare(strict_types=1);

namespace Revolution\Salvager\Facades;

use Illuminate\Support\Facades\Facade;
use Playwright\Browser\BrowserContextInterface;
use Revolution\Salvager\Contracts\Factory;

/**
 * @method void browse(callable $callback)
 * @method BrowserContextInterface launch()
 */
class Salvager extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return Factory::class;
    }
}
