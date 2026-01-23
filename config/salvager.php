<?php

declare(strict_types=1);

return [
    'playwright' => [
        // Playwright options can be added here.

        // 'headless' => true,
        // 'args'     => ['--no-sandbox'],
    ],

    'agent-browser' => [
        /**
         * global: `agent-browser`
         * local: `npx agent-browser`
         */
        'path' => env('SALVAGER_AGENT_BROWSER_PATH', 'agent-browser'),

        /**
         * `--json`
         */
        'options' => env('SALVAGER_AGENT_BROWSER_OPTIONS'),

        /**
         * Chromium install command.
         */
        'install' => [
            // `node ./scripts/install-chromium.js`
            'chromium' => env('SALVAGER_INSTALL_CHROMIUM'),
        ],
    ],

    'screenshots' => storage_path('salvager/screenshots'),
];
