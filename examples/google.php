<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Playwright\Playwright;

$browser = Playwright::chromium();

$page = $browser->newPage();
$page->goto('https://www.google.com/');
$search = $page->getByRole('combobox');
$search->fill('PHP');
//    $search->press('Enter');
//    $page->waitForURL('**/search**');
$file = $page->screenshot(__DIR__.'/screenshots/playwright-google.png');
echo "Screenshot saved to: {$file}\n";

file_put_contents('./examples/html/playwright-google.html', $page->content());

$page->close();
$browser->close();
