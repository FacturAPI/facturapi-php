<?php

declare(strict_types=1);


describe('Receipts', function () {
    test('create sends full json body with all properties', function () {
        mockResponse('{"id":"rec_123"}', 201);
        $receipts = test()->facturapi->receipts();

        $payload = [
            'customer' => 'cus_123',
            'address' => [
                'zip' => '01000',
                'street' => 'Av. Insurgentes Sur'
            ],
            'items' => [
                [
                    'quantity' => 1,
                    'product' => [
                        'description' => 'Servicio',
                        'price' => 100.5,
                        'product_key' => '81111509'
                    ]
                ]
            ],
            'date' => '2025-03-01T12:00:00Z',
            'payment_form' => '03',
            'folio_number' => '12345',
            'currency' => 'USD',
            'exchange' => 20.5,
            'branch' => 'Principal',
            'external_id' => 'ext_001',
            'idempotency_key' => 'idemp_abc123'
        ];

        $result = $receipts->create($payload);

        expect($result->id)->toBe('rec_123');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts');

        $sentPayload = json_decode((string) $request->getBody(), true);
        expect($sentPayload)->toBe($payload);
    });

    test('all serializes query parameters correctly', function () {
        mockResponse('{"data":[]}', 200);
        $receipts = test()->facturapi->receipts();

        $receipts->all([
            'q' => 'recibo',
            'customer' => 'cus_123',
            'payment_form' => '01',
            'date' => [
                'gte' => '2023-01-01',
                'lte' => '2023-12-31'
            ],
            'invoice' => 'inv_123',
            'page' => 2,
            'limit' => 20
        ]);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect(urldecode($request->getUri()->getQuery()))->toBe('q=recibo&customer=cus_123&payment_form=01&date[gte]=2023-01-01&date[lte]=2023-12-31&invoice=inv_123&page=2&limit=20');
    });

    test('retrieve fetches a single receipt', function () {
        mockResponse('{"id":"rec_123"}', 200);
        $receipts = test()->facturapi->receipts();

        $result = $receipts->retrieve('rec_123');

        expect($result->id)->toBe('rec_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts/rec_123');
    });

    test('invoice creates an invoice for a receipt', function () {
        mockResponse('{"id":"inv_123"}', 201);
        $receipts = test()->facturapi->receipts();

        $payload = ['use' => 'G03'];
        $result = $receipts->invoice('rec_123', $payload);

        expect($result->id)->toBe('inv_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts/rec_123/invoice');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('createGlobalInvoice uses expected endpoint', function () {
        mockResponse('{"id":"inv_123"}', 201);
        $receipts = test()->facturapi->receipts();

        $payload = ['periodicity' => '04', 'months' => '03', 'year' => 2025];
        $result = $receipts->createGlobalInvoice($payload);

        expect($result->id)->toBe('inv_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts/global-invoice');
    });

    test('toInvoice creates an invoice from multiple receipts', function () {
        mockResponse('{"id":"inv_123"}', 201);
        $receipts = test()->facturapi->receipts();

        $payload = ['keys' => ['rec_1', 'rec_2'], 'customer' => 'cus_123'];
        $result = $receipts->toInvoice($payload);

        expect($result->id)->toBe('inv_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts/to-invoice');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('previewToInvoicePdf generates a pdf from multiple receipts', function () {
        mockResponse('PDF_BYTES', 200);
        $receipts = test()->facturapi->receipts();

        $payload = ['keys' => ['rec_1', 'rec_2']];
        $result = $receipts->previewToInvoicePdf($payload);

        expect($result)->toBe('PDF_BYTES');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts/to-invoice/preview');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('previewToInvoiceDownloadUrl obtains signed download url using keys', function () {
        mockResponse(json_encode([
            'url' => 'https://facturapi-signed.s3.amazonaws.com/preview.pdf',
            'expires_at' => '2025-03-01T12:00:00Z',
            'content_type' => 'application/pdf',
            'filename' => 'preview.pdf',
        ]), 200);
        $receipts = test()->facturapi->receipts();

        $payload = ['keys' => ['rec_1', 'rec_2']];
        $result = $receipts->previewToInvoiceDownloadUrl($payload);

        expect($result->url)->toBe('https://facturapi-signed.s3.amazonaws.com/preview.pdf');
        expect($result->filename)->toBe('preview.pdf');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts/to-invoice/preview/download-url');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('cancel removes a receipt', function () {
        mockResponse('{"id":"rec_123"}', 200);
        $receipts = test()->facturapi->receipts();

        $result = $receipts->cancel('rec_123');

        expect($result->id)->toBe('rec_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('DELETE');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts/rec_123');
    });

    test('sendByEmail sends single email string to customer', function () {
        mockResponse('{"success":true}', 200);
        $receipts = test()->facturapi->receipts();

        $result = $receipts->sendByEmail('rec_123', 'user@example.com');

        expect($result->success)->toBeTrue();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts/rec_123/email');
        expect(json_decode((string) $request->getBody(), true))->toBe(['email' => ['user@example.com']]);
    });

    test('sendByEmail sends array of emails to customer', function () {
        mockResponse('{"success":true}', 200);
        $receipts = test()->facturapi->receipts();

        $result = $receipts->sendByEmail('rec_123', ['user1@example.com', 'user2@example.com']);

        expect($result->success)->toBeTrue();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts/rec_123/email');
        expect(json_decode((string) $request->getBody(), true))->toBe(['email' => ['user1@example.com', 'user2@example.com']]);
    });

    test('sendByEmail sends empty payload when email is null', function () {
        mockResponse('{"success":true}', 200);
        $receipts = test()->facturapi->receipts();

        $result = $receipts->sendByEmail('rec_123');

        expect($result->success)->toBeTrue();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts/rec_123/email');
        expect((string) $request->getBody())->toBe('');
    });

    test('downloadPdf downloads pdf bytes', function () {
        mockResponse('PDF_BYTES', 200);
        $receipts = test()->facturapi->receipts();

        $result = $receipts->downloadPdf('rec_123');

        expect($result)->toBe('PDF_BYTES');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts/rec_123/pdf');
    });
});
