<?php

declare(strict_types=1);

namespace Tests;

use Revolution\Salvager\Client;
use Revolution\Salvager\Contracts\Factory;

class ClientTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new Client;
    }

    public function test_instance()
    {
        $this->assertInstanceOf(Client::class, $this->client);
    }

    public function test_factory()
    {
        $this->assertInstanceOf(Client::class, app(Factory::class));
    }

    public function test_browse()
    {
        $this->assertTrue(is_callable([$this->client, 'browse']));
    }
}
