<?php

declare(strict_types=1);

namespace Revolution\Salvager;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class AgentBrowser
{
    /**
     * Run any agent-browser command.
     */
    public function run(string $command, ?string $args = null, ?string $options = null): string
    {
        // Install chromium
        if ($install_deps = config('salvager.agent-browser.install.deps')) {
            Process::path(base_path())->timeout(60)->run($install_deps)->throw();
        }
        if ($install_chromium = config('salvager.agent-browser.install.chromium')) {
            Process::path(base_path())->timeout(60)->run($install_chromium)->throw();
        }

        $cmd = collect([
            Config::get('salvager.agent-browser.path'),
            $command,
            $args,
            $options ?? Config::get('salvager.agent-browser.options'),
        ])->filter()
            ->join(' ');

        $result = Process::path(base_path())
            ->env([
                'AGENT_BROWSER_EXECUTABLE_PATH' => Config::get('salvager.agent-browser.executable-path'),
            ])
            ->run($cmd);

        if ($result->failed()) {
            Process::path(base_path())
                ->run(Config::get('salvager.agent-browser.path').' close');

            $result->throw();
        }

        return trim($result->output());
    }

    /**
     * Open a URL in the agent browser.
     */
    public function open(string $url, ?string $options = null): void
    {
        $this->run('open', $url, $options);
    }

    /**
     * Set the User-Agent header.
     */
    public function userAgent(string $userAgent, ?string $options = null): void
    {
        $headers = Str::wrap(json_encode(['User-Agent' => $userAgent]), "'");

        $this->run('set headers', $headers, $options);
    }

    /**
     * Get the current URL.
     */
    public function url(): string
    {
        return $this->run('get', 'url');
    }

    /**
     * Take a screenshot of the current page.
     */
    public function screenshot(string $path): void
    {
        $this->run('screenshot', $path);
    }

    /**
     * Close the agent browser.
     */
    public function close(): void
    {
        $this->run('close');
    }

    /**
     * Get the HTML content of a selector.
     */
    public function html(string $selector, ?string $options = null): string
    {
        return $this->run('get html', $selector, $options);
    }

    /**
     * Get the text content of a selector.
     */
    public function text(string $selector, ?string $options = null): string
    {
        return $this->run('get text', $selector, $options);
    }
}
