<?php

declare(strict_types=1);

namespace Facturapi\Tests\Http;

use Facturapi\Exceptions\FacturapiException;
use Facturapi\Resources\Invoices;
use Facturapi\Tests\Support\FakeHttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class ErrorHandlingNonJsonEdgeCasesTest extends TestCase
{
    public function testInvalidJsonErrorBodyPreservesRawBody(): void
    {
        $rawBody = '{"message": "broken"';

        $httpClient = new FakeHttpClient(
            new Response(500, ['Content-Type' => 'application/json'], $rawBody)
        );

        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        try {
            $invoices->create(['customer' => []]);
            self::fail('Expected FacturapiException to be thrown.');
        } catch (FacturapiException $exception) {
            self::assertSame(500, $exception->getStatusCode());
            self::assertSame($rawBody, $exception->getMessage());
            self::assertNull($exception->getErrorData());
            self::assertSame($rawBody, $exception->getRawBody());
        }
    }

    public function testEmptyErrorBodyIsExposedAsEmptyString(): void
    {
        $httpClient = new FakeHttpClient(
            new Response(500, ['Content-Type' => 'text/plain'], '')
        );

        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        try {
            $invoices->create(['customer' => []]);
            self::fail('Expected FacturapiException to be thrown.');
        } catch (FacturapiException $exception) {
            self::assertSame(500, $exception->getStatusCode());
            self::assertSame('', $exception->getMessage());
            self::assertNull($exception->getErrorData());
            self::assertSame('', $exception->getRawBody());
        }
    }

    public function testPlainTextErrorBodyIsPreserved(): void
    {
        $rawBody = 'gateway overloaded, retry later';

        $httpClient = new FakeHttpClient(
            new Response(503, ['Content-Type' => 'text/plain'], $rawBody)
        );

        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        try {
            $invoices->create(['customer' => []]);
            self::fail('Expected FacturapiException to be thrown.');
        } catch (FacturapiException $exception) {
            self::assertSame(503, $exception->getStatusCode());
            self::assertSame($rawBody, $exception->getMessage());
            self::assertNull($exception->getErrorData());
            self::assertSame($rawBody, $exception->getRawBody());
        }
    }
}
