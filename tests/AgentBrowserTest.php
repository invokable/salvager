<?php

declare(strict_types=1);

namespace Tests;

use Revolution\Salvager\AgentBrowser;
use Revolution\Salvager\Facades\Salvager;

class AgentBrowserTest extends TestCase
{
    public function test_agent()
    {
        Salvager::agent(function (AgentBrowser $agent) use (&$url, &$text, &$html) {
            $agent->userAgent('Salvager');
            $agent->open('https://example.com/');
            $agent->run('wait --load networkidle');
            $agent->screenshot(config('salvager.screenshots').'agent-test.png');

            $url = $agent->url();
            $text = $agent->text('xpath=//p[1]', '--json');
            $html = $agent->html('css=html');

            $agent->close();
        });

        $this->assertEquals('https://example.com/', $url);
        $this->assertGreaterThan(1, mb_strlen($text));
        $this->assertStringContainsString('<head>', $html);
    }
}
