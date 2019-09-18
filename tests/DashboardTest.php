<?php

namespace Tests;

use AgoraApi\Dashboard;

class DashboardTest extends TestCase
{
    /**
     * @var Dashboard
     */
    private $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Dashboard(getenv('CUSTOMER_ID'), getenv('CUSTOMER_CERTIFICATE'));
    }

    public function testProjects()
    {
        $result = $this->client->projects();

        $this->assertEquals(200, $result['code']);
    }
}
