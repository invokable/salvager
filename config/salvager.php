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
         * path to chromium.
         *
         * `/tmp/chromium`
         */
        'executable-path' => env('SALVAGER_AGENT_BROWSER_EXECUTABLE_PATH'),

        /**
         * `--json`
         */
        'options' => env('SALVAGER_AGENT_BROWSER_OPTIONS'),

        /**
         * Chromium install command.
         *
         * `node ./scripts/install-chromium.js`
         */
        'install' => env('SALVAGER_CHROMIUM_INSTALL'),
    ],

    'screenshots' => storage_path('salvager/screenshots'),
];
