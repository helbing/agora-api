<?php

namespace Tests;

use AgoraApi\Token;

class TokenTest extends TestCase
{
    /**
     * @var Token
     */
    private $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Token(getenv('APP_ID'), getenv('APP_CERTIFICATE'));
    }

    public function testRtc()
    {
        $result = $this->client->rtc('test', 'user:1');

        $this->assertIsString($result);
    }

    public function testRtm()
    {
        $result = $this->client->rtm('user:1');

        $this->assertIsString($result);
    }
}
