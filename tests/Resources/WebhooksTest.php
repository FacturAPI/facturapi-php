<?php

declare(strict_types=1);

namespace Facturapi\Tests\Resources;

use Facturapi\Resources\Webhooks;
use Facturapi\Tests\Support\FakeHttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class WebhooksTest extends TestCase
{
    public function testValidateSignatureUsesLocalVerificationByDefault(): void
    {
        $httpClient = new FakeHttpClient();
        $webhooks = new Webhooks('sk_test_abc123', ['httpClient' => $httpClient]);

        $rawPayload = '{"id":"evt_123"}';
        $secret = 'whsec_test_secret';
        $hex = hash_hmac('sha256', $rawPayload, $secret);

        $result = $webhooks->validateSignature([
            'body' => $rawPayload,
            'signature' => 'sha256=' . $hex,
            'webhookSecret' => $secret,
        ]);

        self::assertTrue($result->valid);
        self::assertCount(0, $httpClient->requests());
    }

    public function testValidateSignatureFallsBackToApiEndpointWhenLocalCannotRun(): void
    {
        $httpClient = new FakeHttpClient(new Response(200, [], '{"valid":true}'));
        $webhooks = new Webhooks('sk_test_abc123', ['httpClient' => $httpClient]);

        $payload = [
            'body' => '{"id":"evt_123"}',
            'signature' => 'sha256=fake_signature',
            // No webhookSecret -> triggers API fallback
        ];

        $result = $webhooks->validateSignature($payload);

        self::assertTrue($result->valid);

        $request = $httpClient->requests()[0];
        self::assertSame('POST', $request->getMethod());
        self::assertSame('https://www.facturapi.io/v2/webhooks/validate-signature', (string) $request->getUri());
        self::assertSame('application/json', $request->getHeaderLine('Content-Type'));
        self::assertSame(json_encode($payload), (string) $request->getBody());
    }

    public function testValidateSignatureLocalSupportsRawHexAndRejectsInvalidSignatures(): void
    {
        $httpClient = new FakeHttpClient();
        $webhooks = new Webhooks('sk_test_abc123', ['httpClient' => $httpClient]);

        $rawPayload = '{"id":"evt_456"}';
        $secret = 'whsec_test_secret';
        $hex = hash_hmac('sha256', $rawPayload, $secret);

        $valid = $webhooks->validateSignature([
            'payload' => $rawPayload,
            'signature' => $hex,
            'secret' => $secret,
        ]);
        $invalid = $webhooks->validateSignature([
            'payload' => $rawPayload,
            'signature' => 'sha256=invalid',
            'secret' => $secret,
        ]);

        self::assertTrue($valid->valid);
        self::assertFalse($invalid->valid);
        self::assertCount(0, $httpClient->requests());
    }
}
