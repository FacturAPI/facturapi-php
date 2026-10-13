<?php

declare(strict_types=1);
describe('Retentions', function () {
    test('create can send draft retention payload', function () {
        mockResponse('{"id":"ret_draft","status":"draft"}', 200);
        $retentions = test()->facturapi->retentions();

        $retentions->create([
            'status' => 'draft',
            'customer' => null,
        ]);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions');
        expect((string) $request->getBody())->toBeJson()->and(json_decode((string) $request->getBody(), true))->toBe(json_decode('{"status":"draft","customer":null}', true));
    });
    test('create can send full retention payload', function () {
        mockResponse('{"id":"ret_123"}', 201);
        $retentions = test()->facturapi->retentions();

        $payload = [
            'customer' => 'cus_123',
            'cve_retenc' => '01',
            'fecha_exp' => '2025-03-01T12:00:00Z',
            'desc_retenc' => 'Servicios profesionales',
            'folio_int' => '12345',
            'periodo' => [
                'mes_ini' => '01',
                'mes_fin' => '01',
                'ejerc' => 2025
            ],
            'totales' => [
                'monto_tot_operacion' => 1000.5,
                'monto_tot_grav' => 1000.5,
                'monto_tot_exent' => 0.5,
                'monto_tot_ret' => 100.5,
                'impuestos_retenidos' => [
                    [
                        'base_ret' => 1000.5,
                        'impuesto' => '001',
                        'monto_ret' => 100.5,
                        'tipo_pago_ret' => 'Pago definitivo'
                    ]
                ]
            ],
            'external_id' => 'ext_001',
            'idempotency_key' => 'idemp_ret',
            'pdf_custom_section' => 'Custom text',
            'addenda' => 'XML string',
            'namespaces' => [['namespace' => 'x', 'uri' => 'y']],
            'complements' => [
                [
                    'type' => 'dividendos',
                    'data' => [
                        'cve_tip_div_ou_til' => '01',
                        'monto_is_r_ret_div_ext' => 0,
                        'tip_pago_ret_div_ext' => 'Pago provisional'
                    ]
                ]
            ]
        ];

        $retentions->create($payload);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('update draft uses put on retention id', function () {
        mockResponse('{"id":"ret_123"}', 200);
        $retentions = test()->facturapi->retentions();

        $retentions->updateDraft('ret_123', [
            'folio_int' => 'R-2026-001',
        ]);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions/ret_123');
        expect((string) $request->getBody())->toBeJson()->and(json_decode((string) $request->getBody(), true))->toBe(['folio_int' => 'R-2026-001']);
    });

    test('retrieve fetches a single retention', function () {
        mockResponse('{"id":"ret_123"}', 200);
        $retentions = test()->facturapi->retentions();

        $result = $retentions->retrieve('ret_123');

        expect($result->id)->toBe('ret_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions/ret_123');
    });

    test('sendByEmail sends email to customer', function () {
        mockResponse('{"success":true}', 200);
        $retentions = test()->facturapi->retentions();

        $result = $retentions->sendByEmail('ret_123', ['user@example.com']);

        expect($result->success)->toBeTrue();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions/ret_123/email');
        expect(json_decode((string) $request->getBody(), true))->toBe(['email' => ['user@example.com']]);
    });

    test('downloadPdf downloads pdf bytes', function () {
        mockResponse('PDF_BYTES', 200);
        $retentions = test()->facturapi->retentions();

        $result = $retentions->downloadPdf('ret_123');

        expect($result)->toBe('PDF_BYTES');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions/ret_123/pdf');
    });

    test('downloadXml downloads xml bytes', function () {
        mockResponse('XML_BYTES', 200);
        $retentions = test()->facturapi->retentions();

        $result = $retentions->downloadXml('ret_123');

        expect($result)->toBe('XML_BYTES');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions/ret_123/xml');
    });

    test('downloadZip downloads zip bytes', function () {
        mockResponse('ZIP_BYTES', 200);
        $retentions = test()->facturapi->retentions();

        $result = $retentions->downloadZip('ret_123');

        expect($result)->toBe('ZIP_BYTES');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions/ret_123/zip');
    });
    test('copy to draft uses copy endpoint', function () {
        mockResponse('{"id":"ret_draft"}', 200);
        $retentions = test()->facturapi->retentions();

        $retentions->copyToDraft('ret_123');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions/ret_123/copy');
        expect((string) $request->getBody())->toBe('');
    });
    test('stamp draft uses stamp endpoint', function () {
        mockResponse('{"id":"ret_123","status":"valid"}', 200);
        $retentions = test()->facturapi->retentions();

        $retentions->stampDraft('ret_123');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions/ret_123/stamp');
        expect((string) $request->getBody())->toBe('');
    });
    test('cancel can delete draft without query parameters', function () {
        mockResponse('{"id":"ret_123","deleted":true}', 200);
        $retentions = test()->facturapi->retentions();

        $retentions->cancel('ret_123');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('DELETE');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions/ret_123');
    });
    test('all can filter by draft status', function () {
        mockResponse('{"data":[]}', 200);
        $retentions = test()->facturapi->retentions();

        $retentions->all([
            'status' => 'draft',
        ]);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/retentions?status=draft');
    });

});
