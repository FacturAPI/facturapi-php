<?php

declare(strict_types=1);


describe('NominaCatalogs', function () {
    test('searchDeductions passes query params correctly', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->nominaCatalogs();

        $catalogs->searchDeductions(['q' => 'isr']);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/nomina/deductions?q=isr');
    });

    test('searchPerceptions passes query params correctly', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->nominaCatalogs();

        $catalogs->searchPerceptions(['q' => 'sueldo']);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/nomina/perceptions?q=sueldo');
    });
});
