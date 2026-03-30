<?php

declare(strict_types=1);

namespace Facturapi\Tests\Resources;

use Facturapi\Resources\Webhooks;
use Facturapi\Tests\Support\FakeHttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class WebhooksTest extends TestCase
{
    public function testValidateSignatureCallsApiEndpointWithJsonPayload(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"valid":true}'));
        $webhooks = new Webhooks('sk_test_abc123', ['httpClient' => $httpClient]);

        $payload = [
            'body' => '{"id":"evt_123"}',
            'signature' => 'sha256=fake_signature',
        ];

        $result = $webhooks->validateSignature($payload);

        self::assertTrue($result->valid);

        $request = $httpClient->requests()[0];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/webhooks/validate-signature', (string) $request->getUri());
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertSame(json_encode($payload), (string) $request->getBody());
    }

    public function testVerifySignatureLocallyAcceptsHexAndPrefixedSha256Formats(): void
    {
        $rawPayload = '{"id":"evt_123"}';
        $secret = 'whsec_test_secret';
        $hex = hash_hmac('sha256', $rawPayload, $secret);

        self::assertTrue(Webhooks::verifySignatureLocally($rawPayload, $hex, $secret));
        self::assertTrue(Webhooks::verifySignatureLocally($rawPayload, 'sha256=' . $hex, $secret));
        self::assertFalse(Webhooks::verifySignatureLocally($rawPayload, 'sha256=invalid', $secret));
    }
}
