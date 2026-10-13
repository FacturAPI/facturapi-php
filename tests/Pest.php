<?php

declare(strict_types=1);

uses(\Facturapi\Tests\TestCase::class)->in('Resources', 'Http');

// Add a helper for quickly setting responses
function mockResponse(string $body = '{"ok":true}', int $status = 200, array $headers = []): void
{
    test()->httpClient->addResponse(new \GuzzleHttp\Psr7\Response($status, $headers, $body));
}
