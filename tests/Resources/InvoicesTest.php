<?php

declare(strict_types=1);

namespace Facturapi\Tests\Resources;

use Facturapi\Resources\Invoices;
use Facturapi\Tests\Support\FakeHttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class InvoicesTest extends TestCase
{
    public function testGetLastStatusIsNullBeforeAnyRequest(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{}'));
        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        self::assertNull($invoices->getLastStatus());
    }

    public function testDownloadPdfUsesExpectedPathAndAuthorizationHeader(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], 'PDF_BINARY_CONTENT'));
        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $invoices->downloadPdf('inv_123');

        self::assertSame('PDF_BINARY_CONTENT', $result);

        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/invoices/inv_123/pdf', (string) $request->getUri());
        self::assertSame('Basic ' . base64_encode('sk_test_abc123:'), $request->getHeaderLine('Authorization'));
        self::assertSame('facturapi-php', $request->getHeaderLine('User-Agent'));
        self::assertSame(200, $invoices->getLastStatus());
    }

    public function testAllSerializesNestedDateRangeQueryParametersIntoUrl(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"data":[]}'));
        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        $invoices->all([
            'q' => 'XAXX010101000',
            'date' => [
                'gte' => '2019-03-01',
                'lte' => '2019-03-31',
            ],
        ]);

        $request = $httpClient->requests()[0];
        self::assertSame('https://www.facturapi.io/v2/invoices', $request->getUri()->getScheme() . '://' . $request->getUri()->getHost() . $request->getUri()->getPath());
        self::assertSame(
            'q=XAXX010101000&date[gte]=2019-03-01&date[lte]=2019-03-31',
            urldecode($request->getUri()->getQuery())
        );
    }

    public function testAllUrlEncodesScalarQueryValues(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"data":[]}'));
        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        $invoices->all([
            'q' => 'ACME SA de CV',
        ]);

        $request = $httpClient->requests()[0];
        self::assertSame(
            'https://www.facturapi.io/v2/invoices?q=ACME+SA+de+CV',
            (string) $request->getUri()
        );
    }

    public function testCreateZipRequestUsesExpectedPathAndJsonBody(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"zip_123"}'));
        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);
        $payload = [
            'year' => 2025,
            'month' => 3,
            'issuer_type' => 'issuing',
            'invoice_types' => ['I', 'E'],
        ];

        $result = $invoices->createZipRequest($payload);

        self::assertSame('zip_123', $result->id);
        $request = $httpClient->requests()[0];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/invoices/zip-requests', (string) $request->getUri());
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertSame($payload, json_decode((string) $request->getBody(), true));
    }

    public function testListZipRequestsUsesExpectedPathAndQuery(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"data":[]}'));
        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $invoices->listZipRequests([
            'year' => 2025,
            'month' => 3,
            'status' => 'finished',
            'limit' => 20,
            'page' => 1,
        ]);

        self::assertSame([], $result->data);
        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame(
            'https://www.facturapi.io/v2/invoices/zip-requests?year=2025&month=3&status=finished&limit=20&page=1',
            (string) $request->getUri()
        );
    }

    public function testRetrieveZipRequestUsesExpectedPath(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"zip_123"}'));
        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $invoices->retrieveZipRequest('zip_123');

        self::assertSame('zip_123', $result->id);
        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/invoices/zip-requests/zip_123', (string) $request->getUri());
    }

    public function testDownloadZipRequestReturnsBinaryContentsFromExpectedPath(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], 'ZIP_BINARY_CONTENT'));
        $invoices = new Invoices('sk_test_abc123', ['httpClient' => $httpClient]);

        $result = $invoices->downloadZipRequest('zip_123');

        self::assertSame('ZIP_BINARY_CONTENT', $result);
        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/invoices/zip-requests/zip_123/zip', (string) $request->getUri());
    }
}
