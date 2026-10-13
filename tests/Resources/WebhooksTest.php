<?php

declare(strict_types=1);
describe('Webhooks', function () {
    test('validate signature uses local verification by default', function () {

        $webhooks = test()->facturapi->webhooks();

        $rawPayload = '{"id":"evt_123"}';
        $secret = 'whsec_test_secret';
        $hex = hash_hmac('sha256', $rawPayload, $secret);

        $result = $webhooks->validateSignature([
            'body' => $rawPayload,
            'signature' => 'sha256=' . $hex,
            'webhookSecret' => $secret,
        ]);

        expect($result['valid'])->toBeTrue();
        expect(test()->httpClient->requests())->toHaveCount(0);
    });
    test('validate signature falls back to api endpoint when local cannot run', function () {
        mockResponse('{"valid":true}', 200);
        $webhooks = test()->facturapi->webhooks();

        $payload = [
            'body' => '{"id":"evt_123"}',
            'signature' => 'sha256=fake_signature',
            // No webhookSecret -> triggers API fallback
        ];

        $result = $webhooks->validateSignature($payload);

        expect($result['valid'])->toBeTrue();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/webhooks/validate-signature');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');
        expect((string) $request->getBody())->toBe(json_encode($payload));
    });
    test('validate signature local supports raw hex and rejects invalid signatures', function () {

        $webhooks = test()->facturapi->webhooks();

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

        expect($valid['valid'])->toBeTrue();
        expect($invalid['valid'])->toBeFalse();
        expect(test()->httpClient->requests())->toHaveCount(0);
    });


    test('create sends json body with url and events', function () {
        mockResponse('{"id":"wh_123"}', 201);
        $webhooks = test()->facturapi->webhooks();

        $payload = [
            'url' => 'https://example.com/webhook',
            'enabled_events' => ['invoice.created', 'invoice.paid']
        ];

        $result = $webhooks->create($payload);

        expect($result->id)->toBe('wh_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/webhooks');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('update sends json body with updated properties', function () {
        mockResponse(json_encode([
            'id' => 'wh_123',
            'created_at' => '2025-03-01T12:00:00Z',
            'livemode' => false,
            'organization' => 'org_123',
            'url' => 'https://example.com/webhook-updated',
            'status' => 'active',
            'enabled_events' => ['invoice.created'],
        ]), 200);
        $webhooks = test()->facturapi->webhooks();

        $payload = [
            'url' => 'https://example.com/webhook-updated',
            'status' => 'active',
            'enabled_events' => ['invoice.created'],
        ];

        $result = $webhooks->update('wh_123', $payload);

        expect($result->id)->toBe('wh_123');
        expect($result->url)->toBe('https://example.com/webhook-updated');
        expect($result->status)->toBe('active');
        expect($result->enabled_events)->toBe(['invoice.created']);
        expect($result->organization)->toBe('org_123');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/webhooks/wh_123');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('all retrieves list of webhooks', function () {
        mockResponse('{"data":[]}', 200);
        $webhooks = test()->facturapi->webhooks();

        $webhooks->all();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/webhooks');
    });

    test('retrieve fetches a single webhook by id', function () {
        mockResponse('{"id":"wh_123"}', 200);
        $webhooks = test()->facturapi->webhooks();

        $result = $webhooks->retrieve('wh_123');

        expect($result->id)->toBe('wh_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/webhooks/wh_123');
    });

    test('delete removes a webhook by id', function () {
        mockResponse('{"id":"wh_123"}', 200);
        $webhooks = test()->facturapi->webhooks();

        $result = $webhooks->delete('wh_123');

        expect($result->id)->toBe('wh_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('DELETE');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/webhooks/wh_123');
    });
});
