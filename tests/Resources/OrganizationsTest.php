<?php

declare(strict_types=1);


describe('Organizations', function () {
    test('all retrieves list of organizations', function () {
        mockResponse('{"data":[]}', 200);
        $organizations = test()->facturapi->organizations();

        $organizations->all();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations');
    });

    test('retrieve fetches a single organization by id', function () {
        mockResponse('{"id":"org_123"}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->retrieve('org_123');

        expect($result->id)->toBe('org_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123');
    });

    test('create sends json body with name', function () {
        mockResponse('{"id":"org_123"}', 201);
        $organizations = test()->facturapi->organizations();

        $payload = ['name' => 'Mi Empresa'];
        $result = $organizations->create($payload);

        expect($result->id)->toBe('org_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('updateLegal updates legal info', function () {
        mockResponse(json_encode([
            'id' => 'org_123',
            'name' => 'Mi Empresa',
            'legal' => [
                'legal_name' => 'Empresa SA',
                'tax_id' => 'XAXX010101000',
                'tax_system' => '601',
                'website' => 'https://empresa.example.com',
                'support_email' => 'support@empresa.example.com',
                'phone' => '5512345678',
                'address' => [
                    'zip' => '01000',
                    'street' => 'Av. Insurgentes Sur',
                    'exterior' => '100',
                ],
            ],
        ]), 200);
        $organizations = test()->facturapi->organizations();

        $payload = [
            'name' => 'Mi Empresa',
            'legal_name' => 'Empresa SA',
            'tax_id' => 'XAXX010101000',
            'tax_system' => '601',
            'website' => 'https://empresa.example.com',
            'support_email' => 'support@empresa.example.com',
            'phone' => '5512345678',
            'address' => [
                'zip' => '01000',
                'street' => 'Av. Insurgentes Sur',
                'exterior' => '100',
            ],
        ];
        $result = $organizations->updateLegal('org_123', $payload);

        expect($result->id)->toBe('org_123');
        expect($result->name)->toBe('Mi Empresa');
        expect($result->legal['legal_name'])->toBe('Empresa SA');
        expect($result->legal['tax_id'])->toBe('XAXX010101000');
        expect($result->legal['tax_system'])->toBe('601');
        expect($result->legal['website'])->toBe('https://empresa.example.com');
        expect($result->legal['support_email'])->toBe('support@empresa.example.com');
        expect($result->legal['phone'])->toBe('5512345678');
        expect($result->legal['address']['zip'])->toBe('01000');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/legal');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('updateCustomization updates colors', function () {
        mockResponse(json_encode([
            'id' => 'org_123',
            'customization' => [
                'color' => '#FFFFFF',
                'next_folio_number' => 10,
                'next_folio_number_test' => 5,
                'pdf_extra' => 'Custom footer text',
            ],
        ]), 200);
        $organizations = test()->facturapi->organizations();

        $payload = [
            'color' => '#FFFFFF',
            'next_folio_number' => 10,
            'next_folio_number_test' => 5,
            'pdf_extra' => 'Custom footer text',
        ];
        $result = $organizations->updateCustomization('org_123', $payload);

        expect($result->id)->toBe('org_123');
        expect($result->customization['color'])->toBe('#FFFFFF');
        expect($result->customization['next_folio_number'])->toBe(10);
        expect($result->customization['next_folio_number_test'])->toBe(5);
        expect($result->customization['pdf_extra'])->toBe('Custom footer text');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/customization');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('updateReceiptSettings updates settings', function () {
        mockResponse(json_encode([
            'id' => 'org_123',
            'receipts' => [
                'next_folio_number' => 100,
                'next_folio_number_test' => 50,
                'periodicity' => 'monthly',
                'duration_days' => 30,
                'activate_global_invoice' => true,
                'grouped_items_invoice' => false,
            ],
        ]), 200);
        $organizations = test()->facturapi->organizations();

        $payload = [
            'next_folio_number' => 100,
            'next_folio_number_test' => 50,
            'periodicity' => 'monthly',
            'duration_days' => 30,
            'activate_global_invoice' => true,
            'grouped_items_invoice' => false,
        ];
        $result = $organizations->updateReceiptSettings('org_123', $payload);

        expect($result->id)->toBe('org_123');
        expect($result->receipts['next_folio_number'])->toBe(100);
        expect($result->receipts['next_folio_number_test'])->toBe(50);
        expect($result->receipts['periodicity'])->toBe('monthly');
        expect($result->receipts['duration_days'])->toBe(30);
        expect($result->receipts['activate_global_invoice'])->toBeTrue();
        expect($result->receipts['grouped_items_invoice'])->toBeFalse();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/receipts');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('updateDomain updates domain', function () {
        mockResponse('{"id":"org_123"}', 200);
        $organizations = test()->facturapi->organizations();

        $payload = ['domain' => 'my-domain'];
        $result = $organizations->updateDomain('org_123', $payload);

        expect($result->id)->toBe('org_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/domain');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('updateSelfInvoiceSettings updates self invoice settings', function () {
        mockResponse('{"id":"org_123"}', 200);
        $organizations = test()->facturapi->organizations();

        $payload = ['active' => true];
        $result = $organizations->updateSelfInvoiceSettings('org_123', $payload);

        expect($result->id)->toBe('org_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/self-invoice');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('getTestApiKey retrieves test key', function () {
        mockResponse('{"id":"org_123"}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->getTestApiKey('org_123');

        expect($result['id'])->toBe('org_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/apikeys/test');
    });

    test('renewTestApiKey renews test key', function () {
        mockResponse('{"id":"org_123"}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->renewTestApiKey('org_123');

        expect($result['id'])->toBe('org_123');
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/apikeys/test');
    });

    test('listLiveApiKeys retrieves live keys', function () {
        mockResponse('{"data":[]}', 200);
        $organizations = test()->facturapi->organizations();

        $organizations->listLiveApiKeys('org_123');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/apikeys/live');
    });

    test('createSeriesGroup creates series group for organization', function () {
        mockResponse(json_encode([
            'series' => 'B',
            'next_folio' => 1,
            'next_folio_test' => 1,
        ]), 201);
        $organizations = test()->facturapi->organizations();

        $payload = [
            'series' => 'B',
            'next_folio' => 1,
            'next_folio_test' => 1,
        ];
        $result = $organizations->createSeriesGroup('org_123', $payload);

        expect($result['series'])->toBe('B');
        expect($result['next_folio'])->toBe(1);
        expect($result['next_folio_test'])->toBe(1);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/series-group');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('updateSeriesGroup updates series group for organization', function () {
        mockResponse(json_encode([
            'series' => 'B',
            'next_folio' => 10,
            'next_folio_test' => 5,
        ]), 200);
        $organizations = test()->facturapi->organizations();

        $payload = [
            'next_folio' => 10,
            'next_folio_test' => 5,
        ];
        $result = $organizations->updateSeriesGroup('org_123', 'B', $payload);

        expect($result['series'])->toBe('B');
        expect($result['next_folio'])->toBe(10);
        expect($result['next_folio_test'])->toBe(5);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/series-group/B');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('updateDefaultSeries updates default series for organization', function () {
        mockResponse(json_encode([
            'type' => 'invoice',
            'series' => 'B',
        ]), 200);
        $organizations = test()->facturapi->organizations();

        $payload = [
            'type' => 'invoice',
            'series' => 'B',
        ];
        $result = $organizations->updateDefaultSeries('org_123', $payload);

        expect($result['type'])->toBe('invoice');
        expect($result['series'])->toBe('B');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/series-group/default-series');
        expect(json_decode((string) $request->getBody(), true))->toBe($payload);
    });

    test('deleteSeriesGroup deletes series group for organization', function () {
        mockResponse(json_encode([
            'series' => 'B',
            'next_folio' => 1,
            'next_folio_test' => 1,
        ]), 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->deleteSeriesGroup('org_123', 'B');

        expect($result['series'])->toBe('B');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('DELETE');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/org_123/series-group/B');
    });
});
