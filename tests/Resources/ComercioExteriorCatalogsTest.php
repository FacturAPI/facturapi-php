<?php

declare(strict_types=1);


describe('ComercioExteriorCatalogs', function () {
    test('searchTariffFractions passes query params correctly', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->comercioExteriorCatalogs();

        $catalogs->searchTariffFractions(['q' => '0101']);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/comercioexterior/2.0/tariff-fractions?q=0101');
    });
});
