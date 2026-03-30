<?php

declare(strict_types=1);

namespace Facturapi\Tests\Http;

use Facturapi\Exceptions\FacturapiException;
use Facturapi\Resources\Invoices;
use Facturapi\Tests\Support\FakeHttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class ErrorHandlingTest extends TestCase
{
    public function testApiErrorShapeIsFullyAvailableOnException(): void
    {
        $errorBody = [
            'message' => 'Request validation failed',
            'code' => 'validation_error',
            'details' => [
                [
                    'path' => 'customer.tax_id',
                    'message' => 'customer.tax_id must be a valid RFC',
                    'code' => 'invalid_rfc',
                ],
            ],
        ];

        $httpClient = new FakeHttpClient(
            new Response(422, ['Content-Type' => 'application/json'], json_encode($errorBody))
        );

        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        try {
            $invoices->create(['customer' => []]);
            self::fail('Expected FacturapiException to be thrown.');
        } catch (FacturapiException $exception) {
            self::assertSame(422, $exception->getStatusCode());
            self::assertSame('Request validation failed', $exception->getMessage());
            self::assertSame($errorBody, $exception->getErrorData());
            self::assertSame($errorBody, $exception->getResponseData());
            self::assertSame(json_encode($errorBody), $exception->getRawBody());

            self::assertSame('validation_error', $exception->getErrorData()['code']);
            self::assertSame('customer.tax_id', $exception->getErrorData()['details'][0]['path']);
            self::assertSame('invalid_rfc', $exception->getErrorData()['details'][0]['code']);
        }
    }

    public function testNonJsonErrorsStillExposeRawBody(): void
    {
        $rawBody = '<html><body>502 Bad Gateway</body></html>';

        $httpClient = new FakeHttpClient(
            new Response(502, ['Content-Type' => 'text/html'], $rawBody)
        );

        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        try {
            $invoices->create(['customer' => []]);
            self::fail('Expected FacturapiException to be thrown.');
        } catch (FacturapiException $exception) {
            self::assertSame(502, $exception->getStatusCode());
            self::assertSame($rawBody, $exception->getMessage());
            self::assertNull($exception->getErrorData());
            self::assertSame($rawBody, $exception->getRawBody());
        }
    }
}
