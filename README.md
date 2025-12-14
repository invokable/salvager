# Salvager

Tiny WebCrawler for Laravel using Playwright.

## Version 2

Version 2 has been reworked as a simple package that depends on Playwright. It only implements minimal functionality, since you can use [playwright-php/playwright](https://github.com/playwright-php/playwright) directly.

## Requirements
- PHP >= 8.3
- Laravel >= 12.x

## Installation

```shell
composer require revolution/salvager
```

Install Playwright browsers:
```shell
vendor/bin/playwright-install --browsers
```

Or install Playwright browsers with OS dependencies:
```shell
vendor/bin/playwright-install --with-deps
```

## Usage

The browser will be terminated when you exit `Salvager::browse()`, so please obtain any necessary data within the `Salvager::browse()` closure. The Page object cannot be used outside of `Salvager::browse()`.

```php
use Revolution\Salvager\Facades\Salvager;
use Playwright\Page\Page;

class SalvagerController
{
    public function __invoke()
    {
         Salvager::browse(function (Page $page) use (&$url, &$text) {
            $page->goto('https://example.com/');
            $page->screenshot(config('salvager.screenshots').'example.png');

            $url = $page->url();
            $text = $page->locator('p')->first()->innerText();
        });

        dump($url);
        dump($text);
    }
}
```

If you want more control, just launch the browser with `Salvager::launch()`.

```php
use Playwright\Browser\BrowserContextInterface;
use Revolution\Salvager\Facades\Salvager;

/* @var BrowserContextInterface $browser */
$browser = Salvager::launch();

$page = $browser->newPage();
$page->goto('https://example.com/');
// Do something...

// Don't forget to close the browser
$browser->close();
```

## LICENSE
MIT  
