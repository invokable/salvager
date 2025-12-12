<?php

use PlaywrightPhp\Playwright;

require_once __DIR__.'/../vendor/autoload.php';

$playwright = new Playwright; // launch playwright
$browser = $playwright->launch(); // launch browser

$page = $browser->newPage(); // create new page
$page->goto('https://example.com'); // navigate to example.com
$page->screenshot(['path' => 'examples/screenshots/playwright.png']); // take screenshot

file_put_contents('examples/html/playwright.html', $page->content());
file_put_contents('examples/html/playwright-query.html', $page->querySelector('p')?->innerText());
