<?php

declare(strict_types=1);

return [
    'playwright' => [
        // Playwright options can be added here.

        // 'headless' => true,
        // 'args'     => ['--no-sandbox'],
    ],

    'agent-browser' => [
        'path' => env('SALVAGER_AGENT_BROWSER_PATH', 'agent-browser'),

        /**
         * path to chromium
         */
        'executable-path' => env('SALVAGER_AGENT_BROWSER_EXECUTABLE_PATH'),

        'options' => env('SALVAGER_AGENT_BROWSER_OPTIONS'),
    ],

    'screenshots' => storage_path('salvager/screenshots'),
];
