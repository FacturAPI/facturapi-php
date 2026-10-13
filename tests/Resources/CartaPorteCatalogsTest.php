<?php

declare(strict_types=1);


describe('CartaPorteCatalogs', function () {
    test('searchAirTransportCodes passes query params', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->cartaPorteCatalogs();
        $catalogs->searchAirTransportCodes(['q' => 'abc']);
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/cartaporte/3.1/air-transport-codes?q=abc');
    });

    test('searchTransportConfigs passes query params', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->cartaPorteCatalogs();
        $catalogs->searchTransportConfigs(['q' => 'abc']);
        $request = test()->httpClient->requests()[0];
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/cartaporte/3.1/transport-configs?q=abc');
    });

    test('searchRightsOfPassage passes query params', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->cartaPorteCatalogs();
        $catalogs->searchRightsOfPassage(['q' => 'abc']);
        $request = test()->httpClient->requests()[0];
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/cartaporte/3.1/rights-of-passage?q=abc');
    });

    test('searchCustomsDocuments passes query params', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->cartaPorteCatalogs();
        $catalogs->searchCustomsDocuments(['q' => 'abc']);
        $request = test()->httpClient->requests()[0];
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/cartaporte/3.1/customs-documents?q=abc');
    });

    test('searchPackagingTypes passes query params', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->cartaPorteCatalogs();
        $catalogs->searchPackagingTypes(['q' => 'abc']);
        $request = test()->httpClient->requests()[0];
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/cartaporte/3.1/packaging-types?q=abc');
    });

    test('searchTrailerTypes passes query params', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->cartaPorteCatalogs();
        $catalogs->searchTrailerTypes(['q' => 'abc']);
        $request = test()->httpClient->requests()[0];
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/cartaporte/3.1/trailer-types?q=abc');
    });

    test('searchHazardousMaterials passes query params', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->cartaPorteCatalogs();
        $catalogs->searchHazardousMaterials(['q' => 'abc']);
        $request = test()->httpClient->requests()[0];
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/cartaporte/3.1/hazardous-materials?q=abc');
    });

    test('searchNavalAuthorizations passes query params', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->cartaPorteCatalogs();
        $catalogs->searchNavalAuthorizations(['q' => 'abc']);
        $request = test()->httpClient->requests()[0];
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/cartaporte/3.1/naval-authorizations?q=abc');
    });

    test('searchPortStations passes query params', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->cartaPorteCatalogs();
        $catalogs->searchPortStations(['q' => 'abc']);
        $request = test()->httpClient->requests()[0];
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/cartaporte/3.1/port-stations?q=abc');
    });

    test('searchMarineContainers passes query params', function () {
        mockResponse('{"data":[]}', 200);
        $catalogs = test()->facturapi->cartaPorteCatalogs();
        $catalogs->searchMarineContainers(['q' => 'abc']);
        $request = test()->httpClient->requests()[0];
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/catalogs/cartaporte/3.1/marine-containers?q=abc');
    });
});
