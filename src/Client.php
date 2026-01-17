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
     * Browse the web using Playwright.
     *
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
     * Launch the Playwright browser.
     */
    public function launch(): BrowserContextInterface
    {
        return Playwright::chromium(config('salvager.playwright', []));
    }

    /**
     * Browse the web using AgentBrowser.
     *
     * @param  callable(AgentBrowser $agent): void  $callback
     */
    public function agent(callable $callback): void
    {
        $agent = app(AgentBrowser::class);

        $callback($agent);

        rescue(fn () => $agent->close());
    }
}
