# Salvager

Tiny WebCrawler for Laravel using Playwright.

## Version 2

Version 2 has been reworked as a simple package that depends on Playwright. It only implements minimal functionality, since you can use [playwright-php/playwright](https://github.com/playwright-php/playwright) directly.

In addition, version 2.2 now supports the Vercel [agent-browser](https://github.com/vercel-labs/agent-browser).

## Requirements
- PHP >= 8.3
- Laravel >= 12.x

## Installation

```shell
composer require revolution/salvager
```

### Playwright
Install Playwright browsers:
```shell
vendor/bin/playwright-install --browsers
```

Or install Playwright browsers with OS dependencies:
```shell
vendor/bin/playwright-install --with-deps
```

### Vercel agent-browser

Install agent-browser and Chromium globally and run it as a Laravel Process.

```shell
npm install -g agent-browser
agent-browser install
```

If you want to use custom Chromium binary, you can specify it in .env file.

```dotenv
# .env
AGENT_BROWSER_PATH=/path/to/agent-browser
AGENT_BROWSER_EXECUTABLE_PATH=/path/to/chromium
AGENT_BROWSER_OPTIONS=
```

## Usage

### Playwright

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

### Vercel agent-browser

```php
use Revolution\Salvager\AgentBrowser;
use Revolution\Salvager\Facades\Salvager;

Salvager::agent(function (AgentBrowser $agent) use (&$url, &$text, &$html) {
    $agent->userAgent('Chromium');
    $agent->open('https://example.com/');
    $agent->screenshot(config('salvager.screenshots').'agent-test.png');

    $url = $agent->url();
    $text = $agent->text('xpath=//p[1]', '--json');
    $html = $agent->html('css=html');

    // Run any agent-browser command
    $result = $agent->run(command: '', args: '', options: '');

    $agent->close();
});
```

Since `text()` and `html()` use Playwright's page.locator(), using a CSS selector will result in an error if multiple elements are found. If you want to specify one of multiple elements, use XPath.

## LICENSE
MIT  
