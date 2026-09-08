<?php

declare(strict_types=1);

namespace Facturapi\Tests\Http;

use Facturapi\Facturapi;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Facturapi\Exceptions\FacturapiException;
use Facturapi\Resources\Invoices;
use Facturapi\Tests\Support\FakeHttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class ErrorHandlingTest extends TestCase
{
    public function testGuzzleDefaultLanguageHeaderIsSentWithSdkAuthentication(): void
    {
        $history = [];
        $stack = HandlerStack::create(new MockHandler([
            new Response(401, ['Content-Type' => 'application/json'], json_encode([
                'message' => 'The provided API key is invalid.',
                'code' => 'api_key_invalid',
                'status' => 401,
            ])),
        ]));
        $stack->push(Middleware::history($history));
        $facturapi = new Facturapi('sk_test_123', [
            'httpClient' => new Client([
                'handler' => $stack,
                'headers' => ['Accept-Language' => 'en-US'],
                'timeout' => 360,
                'connect_timeout' => 3,
            ]),
        ]);

        try {
            $facturapi->Invoices->retrieve('inv_123');
            self::fail('Expected FacturapiException');
        } catch (FacturapiException $exception) {
            self::assertSame('The provided API key is invalid.', $exception->getMessage());
            self::assertSame('api_key_invalid', $exception->getErrorCode());
        }
        self::assertSame('en-US', $history[0]['request']->getHeaderLine('Accept-Language'));
        self::assertSame('Basic ' . base64_encode('sk_test_123:'), $history[0]['request']->getHeaderLine('Authorization'));
    }

    public function testApiErrorShapeIsFullyAvailableOnException(): void
    {
        $errorBody = [
            'message' => 'Request validation failed',
            'code' => 'validation_error',
            'path' => 'customer.tax_id',
            'location' => 'body',
            'details' => [
                [
                    'path' => 'customer.tax_id',
                    'message' => 'customer.tax_id must be a valid RFC',
                    'code' => 'invalid_rfc',
                ],
            ],
            'errors' => [
                [
                    'path' => 'customer.tax_id',
                    'location' => 'body',
                    'message' => 'customer.tax_id must be a valid RFC',
                    'code' => 'invalid_rfc',
                ],
            ],
        ];

        $httpClient = new FakeHttpClient(
            new Response(422, [
                'Content-Type' => 'application/json',
                'Retry-After' => '3',
                'x-facturapi-log-id' => 'log_123',
            ], json_encode($errorBody))
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
            self::assertSame('validation_error', $exception->getErrorCode());
            self::assertSame('customer.tax_id', $exception->getErrorPath());
            self::assertSame('body', $exception->getErrorLocation());
            self::assertSame($errorBody['errors'], $exception->getErrors());
            self::assertSame('log_123', $exception->getLogId());
            self::assertSame('3', $exception->getResponseHeaders()['retry-after']);
            self::assertSame('log_123', $exception->getResponseHeaders()['x-facturapi-log-id']);
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

    public function testNumericApiErrorCodesAreConvertedToStrings(): void
    {
        $httpClient = new FakeHttpClient(
            new Response(400, ['Content-Type' => 'application/json'], '{"code": 400}')
        );

        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        try {
            $invoices->create(['customer' => []]);
            self::fail('Expected FacturapiException to be thrown.');
        } catch (FacturapiException $exception) {
            self::assertSame('400', $exception->getErrorCode());
        }
    }
}
