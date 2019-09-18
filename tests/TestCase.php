<?php

namespace Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Dotenv::create(__DIR__ . '/../')->overload();
    }
}
