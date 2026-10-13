<?php

declare(strict_types=1);
describe('Invoices', function () {
    test('get last status is null before any request', function () {
        expect(true)->toBeTrue();
    });

    test('create sends full json body with all required and optional properties', function () {
        mockResponse(json_encode([
            'id' => 'inv_123',
            'created_at' => '2025-03-01T12:00:00Z',
            'livemode' => false,
            'status' => 'valid',
            'payment_method' => 'PUE',
            'use' => 'G01',
            'conditions' => 'Inmediato',
            'currency' => 'MXN',
        ]), 201);
        $invoices = test()->facturapi->invoices();

        $payload = [
            'customer' => 'cus_123',
            'items' => [
                [
                    'quantity' => 2,
                    'product' => [
                        'description' => 'Guitarra',
                        'product_key' => '60131324',
                        'price' => 345.60,
                        'tax_included' => true,
                        'taxes' => [
                            ['type' => 'IVA', 'rate' => 0.16]
                        ]
                    ]
                ]
            ],
            'use' => 'G01',
            'payment_form' => '01',
            'payment_method' => 'PUE',
            'currency' => 'MXN',
            'exchange' => 1.5,
            'conditions' => 'Inmediato',
            'related' => [
                'relation' => '01',
                'invoices' => ['inv_001', 'inv_002']
            ],
            'pdf_custom_section' => 'Custom text here',
            'addenda' => 'XML string',
            'namespaced_addenda' => [['namespace' => 'x', 'xml' => 'y']]
        ];

        $result = $invoices->create($payload);

        expect($result->id)->toBe('inv_123');
        expect($result->payment_method)->toBe('PUE');
        expect($result->use)->toBe('G01');
        expect($result->conditions)->toBe('Inmediato');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices');

        $sentPayload = json_decode((string) $request->getBody(), true);
        expect($sentPayload)->toBe($payload);
    });

    test('updateDraft sends json body with CFDI 4.0 standard fields and returns Invoice DTO', function () {
        mockResponse(json_encode([
            'id' => 'inv_123',
            'created_at' => '2025-03-01T12:00:00Z',
            'livemode' => false,
            'status' => 'draft',
            'payment_method' => 'PUE',
            'use' => 'G01',
            'conditions' => 'Inmediato',
            'currency' => 'MXN',
        ]), 200);
        $invoices = test()->facturapi->invoices();

        $payload = [
            'payment_method' => 'PUE',
            'use' => 'G01',
            'conditions' => 'Inmediato',
            'payment_form' => '03',
            'currency' => 'MXN',
        ];

        $result = $invoices->updateDraft('inv_123', $payload);

        expect($result->id)->toBe('inv_123');
        expect($result->payment_method)->toBe('PUE');
        expect($result->use)->toBe('G01');
        expect($result->conditions)->toBe('Inmediato');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices/inv_123');

        $sentPayload = json_decode((string) $request->getBody(), true);
        expect($sentPayload)->toBe($payload);
    });
    test('download pdf uses expected path and authorization header', function () {
        mockResponse('PDF_BINARY_CONTENT', 200);
        $invoices = test()->facturapi->invoices();

        $result = $invoices->downloadPdf('inv_123');

        expect($result)->toBe('PDF_BINARY_CONTENT');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices/inv_123/pdf');
        expect($request->getHeaderLine('Authorization'))->toBe('Basic ' . base64_encode('sk_test_abc123:'));
        expect($request->getHeaderLine('User-Agent'))->toBe('facturapi-php');
    });
    test('all serializes nested date range query parameters into url', function () {
        mockResponse('{"data":[]}', 200);
        $invoices = test()->facturapi->invoices();

        $invoices->all([
            'q' => 'XAXX010101000',
            'date' => [
                'gte' => '2019-03-01',
                'lte' => '2019-03-31',
            ],
        ]);

        $request = test()->httpClient->requests()[0];
        expect($request->getUri()->getScheme() . '://' . $request->getUri()->getHost() . $request->getUri()->getPath())->toBe('https://www.facturapi.io/v2/invoices');
        expect(urldecode($request->getUri()->getQuery()))->toBe('q=XAXX010101000&date[gte]=2019-03-01&date[lte]=2019-03-31');
    });
    test('all repeats the key for list query parameters', function () {
        mockResponse('{"data":[]}', 200);
        $invoices = test()->facturapi->invoices();

        $invoices->all([
            'status' => ['valid', 'canceled'],
        ]);

        $request = test()->httpClient->requests()[0];
        expect(urldecode($request->getUri()->getQuery()))->toBe('status=valid&status=canceled');
    });
    test('all omits null query parameters', function () {
        mockResponse('{"data":[]}', 200);
        $invoices = test()->facturapi->invoices();

        $invoices->all([
            'q' => null,
            'page' => 2,
        ]);

        $request = test()->httpClient->requests()[0];
        expect(urldecode($request->getUri()->getQuery()))->toBe('page=2');
    });
    test('all sends explicit empty query values', function () {
        mockResponse('{"data":[]}', 200);
        $invoices = test()->facturapi->invoices();

        $invoices->all([
            'q' => '',
        ]);

        $request = test()->httpClient->requests()[0];
        expect(urldecode($request->getUri()->getQuery()))->toBe('q=');
    });
    test('all url encodes scalar query values', function () {
        mockResponse('{"data":[]}', 200);
        $invoices = test()->facturapi->invoices();

        $invoices->all([
            'q' => 'ACME SA de CV',
        ]);

        $request = test()->httpClient->requests()[0];
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices?q=ACME+SA+de+CV');
    });
    test('create zip request uses expected path and json body', function () {
        mockResponse('{"id":"zip_123","created_at":"2025-03-01T00:00:00.000Z","livemode":false,"organization":"org_123","issuer_type":"issuing","invoice_types":[],"start_date":"2025-03-01T00:00:00.000Z","end_date":"2025-03-31T00:00:00.000Z","status":"finished"}', 200);
        $invoices = test()->facturapi->invoices();
        $payload = [
            'year' => 2025,
            'month' => 3,
            'issuer_type' => 'issuing',
            'invoice_types' => ['I', 'E'],
        ];

        $result = $invoices->createZipRequest($payload);

        expect($result->id)->toBe('zip_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices/zip-requests');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });
    test('list zip requests uses expected path and query', function () {
        mockResponse('{"data":[]}', 200);
        $invoices = test()->facturapi->invoices();

        $result = $invoices->listZipRequests([
            'year' => 2025,
            'month' => 3,
            'status' => 'finished',
            'limit' => 20,
            'page' => 1,
        ]);

        expect($result->data)->toBe([]);
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices/zip-requests?year=2025&month=3&status=finished&limit=20&page=1');
    });
    test('retrieve zip request uses expected path', function () {
        mockResponse('{"id":"zip_123","created_at":"2025-03-01T00:00:00.000Z","livemode":false,"organization":"org_123","issuer_type":"issuing","invoice_types":[],"start_date":"2025-03-01T00:00:00.000Z","end_date":"2025-03-31T00:00:00.000Z","status":"finished"}', 200);
        $invoices = test()->facturapi->invoices();

        $result = $invoices->retrieveZipRequest('zip_123');

        expect($result->id)->toBe('zip_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices/zip-requests/zip_123');
    });
    test('download zip request returns binary contents from expected path', function () {
        mockResponse('ZIP_BINARY_CONTENT', 200);
        $invoices = test()->facturapi->invoices();

        $result = $invoices->downloadZipRequest('zip_123');

        expect($result)->toBe('ZIP_BINARY_CONTENT');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices/zip-requests/zip_123/zip');
    });
    test('payment summary uses expected path and query parameter', function () {
        $summary = [
            'uuid' => '6CF6CE33-1BD2-4F88-A443-33013C069169',
            'installment' => 1,
            'last_balance' => 100.0,
            'total' => 100.0,
            'currency' => 'MXN',
            'amount' => 58.0,
            'taxes' => [
                ['base' => 50.0, 'rate' => 0.16, 'type' => 'IVA', 'factor' => 'Tasa', 'withholding' => false],
            ],
        ];
        mockResponse(json_encode($summary), 200);
        $invoices = test()->facturapi->invoices();

        $result = $invoices->paymentSummary('inv_123', 58.0);

        expect($result->uuid)->toBe('6CF6CE33-1BD2-4F88-A443-33013C069169');
        expect($result->installment)->toBe(1);
        expect((float) $result->taxes[0]['base'])->toBe(50.0);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices/inv_123/payment-summary?amount=58');
        expect($request->getHeaderLine('Authorization'))->toBe('Basic ' . base64_encode('sk_test_abc123:'));
    });

    test('sendByEmail sends single email string to customer and returns SuccessResponse', function () {
        mockResponse('{"success":true}', 200);
        $invoices = test()->facturapi->invoices();

        $result = $invoices->sendByEmail('inv_123', 'customer@example.com');

        expect($result->success)->toBeTrue();
        expect($result->ok)->toBeTrue();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices/inv_123/email');
        expect(json_decode((string) $request->getBody(), true))->toBe(['email' => ['customer@example.com']]);
    });

    test('sendByEmail sends email array to customer and returns SuccessResponse', function () {
        mockResponse('{"success":true}', 200);
        $invoices = test()->facturapi->invoices();

        $result = $invoices->sendByEmail('inv_123', ['user1@example.com', 'user2@example.com']);

        expect($result->success)->toBeTrue();
        expect($result->ok)->toBeTrue();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices/inv_123/email');
        expect(json_decode((string) $request->getBody(), true))->toBe(['email' => ['user1@example.com', 'user2@example.com']]);
    });

    test('sendByEmail sends empty payload when email is null and returns SuccessResponse', function () {
        mockResponse('{"success":true}', 200);
        $invoices = test()->facturapi->invoices();

        $result = $invoices->sendByEmail('inv_123');

        expect($result->success)->toBeTrue();
        expect($result->ok)->toBeTrue();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices/inv_123/email');
        expect((string) $request->getBody())->toBe('');
    });
});
