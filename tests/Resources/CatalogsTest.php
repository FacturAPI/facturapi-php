<?php

declare(strict_types=1);


describe('Catalogs', function () {
    test('searchProducts passes query params correctly', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->catalogs();

        $catalogs->searchProducts(['q' => 'computadora']);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/products?q=computadora');
    });

    test('searchUnits passes query params correctly', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->catalogs();

        $catalogs->searchUnits(['q' => 'pieza']);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/units?q=pieza');
    });
});
