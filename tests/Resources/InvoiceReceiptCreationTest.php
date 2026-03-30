<?php

declare(strict_types=1);

namespace Facturapi\Tests\Resources;

use Facturapi\Resources\Invoices;
use Facturapi\Resources\Receipts;
use Facturapi\Tests\Support\FakeHttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class InvoiceReceiptCreationTest extends TestCase
{
    public function testInvoicesCreateSendsJsonBodyAndQueryParams(): void
    {
        $httpClient = new FakeHttpClient(new Response(201, [], '{"id":"inv_123"}'));
        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        $payload = [
            'customer' => 'cus_123',
            'items' => [['quantity' => 1]],
        ];

        $result = $invoices->create($payload, ['as' => 'draft', 'validate' => true]);

        self::assertSame('inv_123', $result->id);

        $request = $httpClient->requests()[0];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/invoices?as=draft&validate=true', (string) $request->getUri());
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertSame(json_encode($payload), (string) $request->getBody());
    }

    public function testReceiptsCreateSendsJsonBodyToExpectedEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(201, [], '{"id":"rec_123"}'));
        $receipts = new Receipts('sk_test_abc123', ['httpClient' => $httpClient]);

        $payload = [
            'customer' => 'cus_123',
            'items' => [['quantity' => 1]],
        ];

        $result = $receipts->create($payload);

        self::assertSame('rec_123', $result->id);

        $request = $httpClient->requests()[0];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/receipts', (string) $request->getUri());
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertSame(json_encode($payload), (string) $request->getBody());
    }

    public function testInvoicesCancelSerializesQueryParamsWithoutExtraSlash(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"status":"canceled"}'));
        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        $invoices->cancel('inv_123', ['motive' => '01', 'substitution' => 'inv_456']);

        $request = $httpClient->requests()[0];
        self::assertSame(
            'https://www.facturapi.io/v2/invoices/inv_123?motive=01&substitution=inv_456',
            (string) $request->getUri()
        );
    }
}
