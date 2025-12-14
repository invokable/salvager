<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Playwright\Playwright;

$browser = Playwright::chromium();

$page = $browser->newPage();
$page->goto('https://example.com');

$page->screenshot(__DIR__.'/screenshots/playwright.png');

file_put_contents('./examples/html/playwright.html', $page->content());
file_put_contents('./examples/html/playwright-locator.html', $page->locator('p')->first()->innerHTML());

$page->close();
$browser->close();
