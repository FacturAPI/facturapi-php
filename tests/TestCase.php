<?php

declare(strict_types=1);

namespace Facturapi\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Facturapi\Tests\Support\FakeHttpClient;
use Facturapi\Facturapi;

abstract class TestCase extends BaseTestCase
{
    public FakeHttpClient $httpClient;
    public Facturapi $facturapi;

    protected function setUp(): void
    {
        parent::setUp();

        $this->httpClient = new FakeHttpClient();
        $this->facturapi = new Facturapi('sk_test_abc123', ['httpClient' => $this->httpClient]);
    }
}
