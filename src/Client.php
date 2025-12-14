<?php

declare(strict_types=1);

namespace Revolution\Salvager;

use Playwright\Browser\BrowserContextInterface;
use Playwright\Page\Page;
use Playwright\Playwright;
use Revolution\Salvager\Contracts\Factory;

class Client implements Factory
{
    /**
     * @param  callable(Page $page): void  $callback
     */
    public function browse(callable $callback): void
    {
        $browser = $this->launch();

        $page = $browser->newPage();

        $callback($page);

        rescue(fn () => $page->close());
        rescue(fn () => $browser->close());
    }

    /**
     * Launch the browser.
     */
    public function launch(): BrowserContextInterface
    {
        return Playwright::chromium(config('salvager.playwright', []));
    }
}
