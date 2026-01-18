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
         */
        'install' => [
            // `dnf install -y nss nspr atk at-spi2-atk cups-libs libdrm libXcomposite libXdamage libXrandr mesa-libgbm pango alsa-lib libxkbcommon libxcb libX11-xcb libX11 libXext libXcursor libXfixes libXi gtk3 cairo-gobject`
            'deps' => env('SALVAGER_INSTALL_DEPS'),
            // `node ./scripts/install-chromium.js`
            'chromium' => env('SALVAGER_INSTALL_CHROMIUM'),
        ],
    ],

    'screenshots' => storage_path('salvager/screenshots'),
];
