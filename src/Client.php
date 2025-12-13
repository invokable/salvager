<?php

declare(strict_types=1);

namespace Revolution\Salvager;

use Illuminate\Container\Container;
use PlaywrightPhp\Playwright;
use PlaywrightPhp\Resources\Browser;
use PlaywrightPhp\Resources\Page;
use Revolution\Salvager\Contracts\Factory;

class Client implements Factory
{
    /**
     * @param  callable(Page $page): void  $callback
     */
    public function browse(callable $callback): void
    {
        $playwright = Container::getInstance()->make(Playwright::class);

        $browser = $playwright->launch();

        $page = $browser->newPage();

        $callback($page);

        $browser->close();
    }

    /**
     * Launch the browser.
     */
    public function launch(): Browser
    {
        $playwright = Container::getInstance()->make(Playwright::class);

        return $playwright->launch();
    }
}
