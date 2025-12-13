# Salvager

Tiny WebCrawler for Laravel using Playwright.

## Version 2

Version 2 has been reworked as a simple package that depends on Playwright. It only implements minimal functionality, since you can use [victor-teles/playwright-php](https://github.com/victor-teles/playwright-php) directly.

## Requirements
- PHP >= 8.3
- Laravel >= 12.x

## Installation

```shell
composer require revolution/salvager
```

This package also requires the installation of npm packages and browser binaries.

```shell
npm install https://github.com/victor-teles/playwright-php/tarball/main

npx playwright install
```

## Usage

The browser will be terminated when you exit `Salvager::browse()`, so please obtain any necessary data within the `Salvager::browse()` closure. The Page object cannot be used outside of `Salvager::browse()`.

```php
use Revolution\Salvager\Facades\Salvager;
use PlaywrightPhp\Resources\Page;

class SalvagerController
{
    public function __invoke()
    {
         Salvager::browse(function (Page $page) use (&$url, &$text) {
            $page->goto('https://example.com/');
            $page->screenshot(['path' => config('salvager.screenshots').'example.png']);

            $url = $page->url();
            $text = $page->querySelector('p')?->innerText();
        });

        dump($url);
        dump($text);
    }
}
```

## LICENSE
MIT  
