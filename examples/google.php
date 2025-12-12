<?php

/**
 * Plain PHP example.
 */
require_once __DIR__.'/../vendor/autoload.php';

use PlaywrightPhp\Resources\Page;
use Revolution\Salvager\Client;

$client = new Client;

$client->browse(function (Page $page) {
    $page->goto('https://www.google.com/');
    $search = $page->getByRole('combobox');
    $search->fill('PHP');
    $search->press('Enter');
    $page->waitForURL('**/search**');
    $page->screenshot(['path' => 'examples/screenshots/playwright-google.png']);

    file_put_contents('examples/html/playwright-google.html', $page->content());
});
