<?php

declare(strict_types=1);

namespace Facturapi\Tests\Resources;

use Facturapi\Resources\Retentions;
use Facturapi\Tests\Support\FakeHttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class RetentionsTest extends TestCase
{
    public function testCreateCanSendDraftRetentionPayload(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"ret_draft","status":"draft"}'));
        $retentions = new Retentions('sk_test_abc123', ['httpClient' => $httpClient]);

        $retentions->create([
            'status' => 'draft',
            'customer' => null,
        ]);

        $request = $httpClient->requests()[0];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/retentions', (string) $request->getUri());
        self::assertJsonStringEqualsJsonString(
            '{"status":"draft","customer":null}',
            (string) $request->getBody()
        );
    }

    public function testUpdateDraftUsesPutOnRetentionId(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"ret_123"}'));
        $retentions = new Retentions('sk_test_abc123', ['httpClient' => $httpClient]);

        $retentions->updateDraft('ret_123', [
            'folio_int' => 'R-2026-001',
        ]);

        $request = $httpClient->requests()[0];
        self::assertSame('PUT', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/retentions/ret_123', (string) $request->getUri());
        self::assertJsonStringEqualsJsonString(
            '{"folio_int":"R-2026-001"}',
            (string) $request->getBody()
        );
    }

    public function testCopyToDraftUsesCopyEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"ret_draft"}'));
        $retentions = new Retentions('sk_test_abc123', ['httpClient' => $httpClient]);

        $retentions->copyToDraft('ret_123');

        $request = $httpClient->requests()[0];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/retentions/ret_123/copy', (string) $request->getUri());
        self::assertSame('', (string) $request->getBody());
    }

    public function testStampDraftUsesStampEndpoint(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"ret_123","status":"valid"}'));
        $retentions = new Retentions('sk_test_abc123', ['httpClient' => $httpClient]);

        $retentions->stampDraft('ret_123');

        $request = $httpClient->requests()[0];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/retentions/ret_123/stamp', (string) $request->getUri());
        self::assertSame('', (string) $request->getBody());
    }

    public function testCancelCanDeleteDraftWithoutQueryParameters(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"id":"ret_123","deleted":true}'));
        $retentions = new Retentions('sk_test_abc123', ['httpClient' => $httpClient]);

        $retentions->cancel('ret_123');

        $request = $httpClient->requests()[0];
        self::assertSame('DELETE', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/retentions/ret_123', (string) $request->getUri());
    }

    public function testAllCanFilterByDraftStatus(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"data":[]}'));
        $retentions = new Retentions('sk_test_abc123', ['httpClient' => $httpClient]);

        $retentions->all([
            'status' => 'draft',
        ]);

        $request = $httpClient->requests()[0];
        self::assertSame('GET', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/retentions?status=draft', (string) $request->getUri());
    }
}
