<?php

declare(strict_types=1);


use Facturapi\Models\CommonAddressProperties;
use Facturapi\Models\Customer;
use Facturapi\Models\CustomerSearchResult;
use Facturapi\Models\OkResponse;
use Facturapi\Models\TaxIdValidationResult;

describe('Customers', function () {
    test('create sends full json body with all required and optional properties', function () {
        $jsonResponse = '{
            "id": "cus_123",
            "created_at": "2026-10-12T00:00:00.000Z",
            "livemode": false,
            "legal_name": "ACME SA DE CV",
            "tax_id": "XAXX010101000",
            "tax_system": "601",
            "email": "contact@acme.com",
            "phone": "5555555555",
            "default_invoice_use": "G01",
            "address": {
                "zip": "01000",
                "street": "Av. de los Insurgentes Sur",
                "exterior": "123",
                "interior": "Piso 4",
                "neighborhood": "Roma Norte",
                "city": "Ciudad de México",
                "municipality": "Cuauhtémoc",
                "state": "DIF",
                "country": "MEX"
            },
            "edit_link": "https://auto.facturapi.io/tax-info/abcdWXYZ1234",
            "edit_link_expires_at": "2026-10-19T00:00:00.000Z",
            "sat_validated_at": "2026-10-12T00:00:00.000Z"
        }';
        mockResponse($jsonResponse, 201);
        $customers = test()->facturapi->customers();

        $payload = [
            'legal_name' => 'ACME SA DE CV',
            'tax_id' => 'XAXX010101000',
            'tax_system' => '601',
            'email' => 'contact@acme.com',
            'phone' => '5555555555',
            'default_invoice_use' => 'G01',
            'address' => [
                'zip' => '01000',
                'street' => 'Av. de los Insurgentes Sur',
                'exterior' => '123',
                'interior' => 'Piso 4',
                'neighborhood' => 'Roma Norte',
                'city' => 'Ciudad de México',
                'municipality' => 'Cuauhtémoc',
                'state' => 'DIF',
                'country' => 'MEX',
            ],
        ];

        $result = $customers->create($payload, ['createEditLink' => 1]);

        expect($result)->toBeInstanceOf(Customer::class)
            ->and($result->id)->toBe('cus_123')
            ->and($result->created_at)->toBe('2026-10-12T00:00:00.000Z')
            ->and($result->livemode)->toBeFalse()
            ->and($result->legal_name)->toBe('ACME SA DE CV')
            ->and($result->tax_id)->toBe('XAXX010101000')
            ->and($result->tax_system)->toBe('601')
            ->and($result->email)->toBe('contact@acme.com')
            ->and($result->phone)->toBe('5555555555')
            ->and($result->default_invoice_use)->toBe('G01')
            ->and($result->address)->toBeInstanceOf(CommonAddressProperties::class)
            ->and($result->address->zip)->toBe('01000')
            ->and($result->address->street)->toBe('Av. de los Insurgentes Sur')
            ->and($result->address->exterior)->toBe('123')
            ->and($result->address->interior)->toBe('Piso 4')
            ->and($result->address->neighborhood)->toBe('Roma Norte')
            ->and($result->address->city)->toBe('Ciudad de México')
            ->and($result->address->municipality)->toBe('Cuauhtémoc')
            ->and($result->address->state)->toBe('DIF')
            ->and($result->address->country)->toBe('MEX')
            ->and($result->address['zip'])->toBe('01000')
            ->and($result->edit_link)->toBe('https://auto.facturapi.io/tax-info/abcdWXYZ1234')
            ->and($result->edit_link_expires_at)->toBe('2026-10-19T00:00:00.000Z')
            ->and($result->sat_validated_at)->toBe('2026-10-12T00:00:00.000Z');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/customers?createEditLink=1');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');

        $sentPayload = json_decode((string) $request->getBody(), true);
        expect($sentPayload)->toBe($payload);
    });

    test('update sends json body with all editable properties', function () {
        $jsonResponse = '{
            "id": "cus_123",
            "created_at": "2026-10-12T00:00:00.000Z",
            "livemode": false,
            "legal_name": "ACME Modificado SA DE CV",
            "tax_id": "XAXX010101000",
            "tax_system": "606",
            "email": "new@acme.com",
            "phone": "5551234567",
            "default_invoice_use": "G03",
            "address": {
                "zip": "03100",
                "street": "Calle Morelos",
                "exterior": "456",
                "interior": "Depto 2",
                "neighborhood": "Del Valle",
                "city": "Ciudad de México",
                "municipality": "Benito Juárez",
                "state": "CDMX",
                "country": "MEX"
            },
            "edit_link": null,
            "edit_link_expires_at": null,
            "sat_validated_at": "2026-10-12T01:00:00.000Z"
        }';
        mockResponse($jsonResponse, 200);
        $customers = test()->facturapi->customers();

        $payload = [
            'legal_name' => 'ACME Modificado SA DE CV',
            'tax_id' => 'XAXX010101000',
            'tax_system' => '606',
            'email' => 'new@acme.com',
            'phone' => '5551234567',
            'default_invoice_use' => 'G03',
            'address' => [
                'zip' => '03100',
                'street' => 'Calle Morelos',
                'exterior' => '456',
                'interior' => 'Depto 2',
                'neighborhood' => 'Del Valle',
                'city' => 'Ciudad de México',
                'municipality' => 'Benito Juárez',
                'state' => 'CDMX',
                'country' => 'MEX',
            ],
        ];

        $result = $customers->update('cus_123', $payload, ['createEditLink' => 0]);

        expect($result)->toBeInstanceOf(Customer::class)
            ->and($result->id)->toBe('cus_123')
            ->and($result->legal_name)->toBe('ACME Modificado SA DE CV')
            ->and($result->tax_id)->toBe('XAXX010101000')
            ->and($result->tax_system)->toBe('606')
            ->and($result->email)->toBe('new@acme.com')
            ->and($result->phone)->toBe('5551234567')
            ->and($result->default_invoice_use)->toBe('G03')
            ->and($result->address)->toBeInstanceOf(CommonAddressProperties::class)
            ->and($result->address->zip)->toBe('03100')
            ->and($result->address->street)->toBe('Calle Morelos')
            ->and($result->address->exterior)->toBe('456')
            ->and($result->address->interior)->toBe('Depto 2')
            ->and($result->address->neighborhood)->toBe('Del Valle')
            ->and($result->address->city)->toBe('Ciudad de México')
            ->and($result->address->municipality)->toBe('Benito Juárez')
            ->and($result->address->state)->toBe('CDMX')
            ->and($result->address->country)->toBe('MEX')
            ->and($result->sat_validated_at)->toBe('2026-10-12T01:00:00.000Z');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/customers/cus_123?createEditLink=0');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');

        $sentPayload = json_decode((string) $request->getBody(), true);
        expect($sentPayload)->toBe($payload);
    });

    test('retrieve fetches a single customer by id with full typed DTO properties', function () {
        $jsonResponse = '{
            "id": "cus_123",
            "created_at": "2026-10-12T00:00:00.000Z",
            "livemode": false,
            "legal_name": "ACME SA DE CV",
            "tax_id": "XAXX010101000",
            "tax_system": "601",
            "email": "contact@acme.com",
            "phone": "5555555555",
            "default_invoice_use": "G01",
            "address": {
                "zip": "01000",
                "street": "Av. de los Insurgentes Sur",
                "exterior": "123",
                "interior": "Piso 4",
                "neighborhood": "Roma Norte",
                "city": "Ciudad de México",
                "municipality": "Cuauhtémoc",
                "state": "DIF",
                "country": "MEX"
            },
            "edit_link": "https://auto.facturapi.io/tax-info/abcdWXYZ1234",
            "edit_link_expires_at": "2026-10-19T00:00:00.000Z",
            "sat_validated_at": "2026-10-12T00:00:00.000Z"
        }';
        mockResponse($jsonResponse, 200);
        $customers = test()->facturapi->customers();

        $result = $customers->retrieve('cus_123');

        expect($result)->toBeInstanceOf(Customer::class)
            ->and($result->id)->toBe('cus_123')
            ->and($result->created_at)->toBe('2026-10-12T00:00:00.000Z')
            ->and($result->livemode)->toBeFalse()
            ->and($result->legal_name)->toBe('ACME SA DE CV')
            ->and($result->tax_id)->toBe('XAXX010101000')
            ->and($result->tax_system)->toBe('601')
            ->and($result->email)->toBe('contact@acme.com')
            ->and($result->phone)->toBe('5555555555')
            ->and($result->default_invoice_use)->toBe('G01')
            ->and($result->address)->toBeInstanceOf(CommonAddressProperties::class)
            ->and($result->address->zip)->toBe('01000')
            ->and($result->address->street)->toBe('Av. de los Insurgentes Sur')
            ->and($result->address->state)->toBe('DIF')
            ->and($result->address->country)->toBe('MEX')
            ->and($result->edit_link)->toBe('https://auto.facturapi.io/tax-info/abcdWXYZ1234');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/customers/cus_123');
    });

    test('delete removes a customer by id and returns Customer DTO', function () {
        $jsonResponse = '{
            "id": "cus_123",
            "created_at": "2026-10-12T00:00:00.000Z",
            "livemode": false,
            "legal_name": "ACME SA DE CV"
        }';
        mockResponse($jsonResponse, 200);
        $customers = test()->facturapi->customers();

        $result = $customers->delete('cus_123');

        expect($result)->toBeInstanceOf(Customer::class)
            ->and($result->id)->toBe('cus_123')
            ->and($result->legal_name)->toBe('ACME SA DE CV');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('DELETE');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/customers/cus_123');
    });

    test('all serializes query parameters correctly and returns CustomerSearchResult', function () {
        $jsonResponse = '{
            "page": 1,
            "total_pages": 3,
            "total_results": 150,
            "previous_cursor": null,
            "next_cursor": "cur_next_123",
            "totals_are_capped": false,
            "data": [
                {
                    "id": "cus_123",
                    "created_at": "2026-10-12T00:00:00.000Z",
                    "livemode": false,
                    "legal_name": "ACME SA DE CV",
                    "tax_id": "XAXX010101000",
                    "tax_system": "601",
                    "email": "contact@acme.com",
                    "phone": "5555555555",
                    "default_invoice_use": "G01",
                    "address": {
                        "zip": "01000",
                        "street": "Av. de los Insurgentes Sur",
                        "state": "DIF",
                        "country": "MEX"
                    }
                }
            ]
        }';
        mockResponse($jsonResponse, 200);
        $customers = test()->facturapi->customers();

        $result = $customers->all([
            'q' => 'acme',
            'date' => [
                'gte' => '2023-01-01',
                'lte' => '2023-12-31',
            ],
            'page' => 1,
            'limit' => 50,
        ]);

        expect($result)->toBeInstanceOf(CustomerSearchResult::class)
            ->and($result->page)->toBe(1)
            ->and($result->total_pages)->toBe(3)
            ->and($result->total_results)->toBe(150)
            ->and($result->previous_cursor)->toBeNull()
            ->and($result->next_cursor)->toBe('cur_next_123')
            ->and($result->totals_are_capped)->toBeFalse()
            ->and($result->data)->toBeArray()->toHaveCount(1)
            ->and($result->data[0])->toBeInstanceOf(Customer::class)
            ->and($result->data[0]->id)->toBe('cus_123')
            ->and($result->data[0]->legal_name)->toBe('ACME SA DE CV')
            ->and($result->data[0]->address)->toBeInstanceOf(CommonAddressProperties::class)
            ->and($result->data[0]->address->state)->toBe('DIF')
            ->and($result->data[0]->address->country)->toBe('MEX');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect(urldecode($request->getUri()->getQuery()))->toBe('q=acme&date[gte]=2023-01-01&date[lte]=2023-12-31&page=1&limit=50');
    });

    test('all serializes cursor and date comparison query parameters correctly', function () {
        mockResponse('{"page":1,"total_pages":1,"total_results":0,"data":[]}', 200);
        $customers = test()->facturapi->customers();

        $result = $customers->all([
            'after' => 'cur_after_abc',
            'before' => 'cur_before_xyz',
            'date' => [
                'gt' => '2023-01-01',
                'lt' => '2023-06-01',
            ],
        ]);

        expect($result)->toBeInstanceOf(CustomerSearchResult::class)
            ->and($result->data)->toBeArray()->toBeEmpty();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect(urldecode($request->getUri()->getQuery()))->toBe('after=cur_after_abc&before=cur_before_xyz&date[gt]=2023-01-01&date[lt]=2023-06-01');
    });

    test('validate tax info returns valid TaxIdValidationResult for valid RFC', function () {
        mockResponse('{"is_valid": true, "efos": null, "errors": null}', 200);
        $customers = test()->facturapi->customers();

        $result = $customers->validateTaxInfo('cus_123');

        expect($result)->toBeInstanceOf(TaxIdValidationResult::class)
            ->and($result->is_valid)->toBeTrue()
            ->and($result->efos)->toBeNull()
            ->and($result->errors)->toBeNull();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/customers/cus_123/tax-info-validation');
    });

    test('validate tax info returns invalid TaxIdValidationResult with SAT errors', function () {
        $jsonResponse = '{
            "is_valid": false,
            "errors": [
                {
                    "source": "sat",
                    "code": "tax_id_invalid",
                    "message": "El RFC no se encuentra registrado en el padrón de contribuyentes"
                }
            ]
        }';
        mockResponse($jsonResponse, 200);
        $customers = test()->facturapi->customers();

        $result = $customers->validateTaxInfo('cus_123');

        expect($result)->toBeInstanceOf(TaxIdValidationResult::class)
            ->and($result->is_valid)->toBeFalse()
            ->and($result->errors)->toBeArray()->toHaveCount(1)
            ->and($result->errors[0]['source'])->toBe('sat')
            ->and($result->errors[0]['code'])->toBe('tax_id_invalid')
            ->and($result->errors[0]['message'])->toBe('El RFC no se encuentra registrado en el padrón de contribuyentes');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/customers/cus_123/tax-info-validation');
    });

    test('send edit link by email sends correct payload and returns OkResponse', function () {
        mockResponse('{"ok":true}', 200);
        $customers = test()->facturapi->customers();

        $payload = ['email' => 'edit@acme.com'];
        $result = $customers->sendEditLink('cus_123', $payload);

        expect($result)->toBeInstanceOf(OkResponse::class)
            ->and($result->ok)->toBeTrue()
            ->and($result->success)->toBeTrue();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/customers/cus_123/email-edit-link');

        $sentPayload = json_decode((string) $request->getBody(), true);
        expect($sentPayload)->toBe($payload);
    });

    test('send edit link with default empty payload sends empty body and returns OkResponse', function () {
        mockResponse('{"ok":true}', 200);
        $customers = test()->facturapi->customers();

        $result = $customers->sendEditLink('cus_123');

        expect($result)->toBeInstanceOf(OkResponse::class)
            ->and($result->ok)->toBeTrue()
            ->and($result->success)->toBeTrue();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/customers/cus_123/email-edit-link');

        $sentPayload = (string) $request->getBody();
        expect($sentPayload)->toBe('');
    });
});
