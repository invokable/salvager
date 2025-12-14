<?php

declare(strict_types=1);

namespace Tests;

use Mockery;
use Playwright\Browser\BrowserContextInterface;
use Playwright\Page\Page;
use Revolution\Salvager\Facades\Salvager;

class BrowseTest extends TestCase
{
    public function test_browse()
    {
        Salvager::browse(function (Page $page) use (&$url, &$text) {
            $page->goto('https://example.com/');
            $page->screenshot(path: config('salvager.screenshots').'playwright-test.png');

            $url = $page->url();
            $text = $page->locator('p')?->first()->innerText();
        });

        $this->assertEquals('https://example.com/', $url);
        $this->assertGreaterThan(1, mb_strlen($text));
    }

    public function test_launch()
    {
        $browser = Salvager::launch();

        $this->assertInstanceOf(BrowserContextInterface::class, $browser);

        $browser->close();
    }

    public function test_facade()
    {
        Salvager::expects('browse')
            ->with(Mockery::type('callable'))
            ->once()
            ->andReturnNull();

        Salvager::browse(function (Page $page) use (&$url, &$text) {
            $page->goto('https://example.com/');
            $page->screenshot(path: config('salvager.screenshots').'playwright-test.png');

            $url = $page->url();
            $text = $page->locator('p')?->first()->innerText();
        });

        $this->assertNull($url);
        $this->assertNull($text);
    }
}
