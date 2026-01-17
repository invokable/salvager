<?php

declare(strict_types=1);

namespace Revolution\Salvager;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Process;

class AgentBrowser
{
    public function run(string $command, ?string $args = null, ?string $options = null): string
    {
        $cmd = collect([
            Config::get('salvager.agent-browser.path'),
            filled(Config::get('salvager.agent-browser.executable-path')) ? '--executable-path '.Config::get('salvager.agent-browser.executable-path') : null,
            $command,
            $args,
            $options ?? Config::get('salvager.agent-browser.options'),
        ])->filter()
            ->join(' ');

        $result = Process::path(base_path())
            ->run($cmd)
            ->throw();

        return trim($result->output());
    }

    public function open(string $url): void
    {
        $this->run('open', $url);
    }

    public function url(): string
    {
        return $this->run('get', 'url');
    }

    public function screenshot(string $path): void
    {
        $this->run('screenshot', $path);
    }

    public function close(): void
    {
        $this->run('close');
    }

    public function html(string $selector, ?string $options = null): string
    {
        return $this->run('get html', $selector, $options);
    }

    public function text(string $selector, ?string $options = null): string
    {
        return $this->run('get text', $selector, $options);
    }
}
