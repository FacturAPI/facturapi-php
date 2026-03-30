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
}
