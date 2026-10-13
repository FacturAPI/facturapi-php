<?php

declare(strict_types=1);
describe('OrganizationsDomain', function () {
    test('all serializes query parameters into url', function () {
        mockResponse('{"data":[]}', 200);
        $organizations = test()->facturapi->organizations();

        $organizations->all([
            'q' => 'XAXX010101000',
        ]);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations?q=XAXX010101000');
    });
    test('check domain availability uses expected endpoint', function () {
        mockResponse('{"available":true}', 200);
        $organizations = test()->facturapi->organizations();

        $result = $organizations->checkDomainAvailability([
            'name' => 'acme',
            'domain' => 'acme.mx',
        ]);

        expect($result->available)->toBeTrue();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/organizations/domain-check?name=acme&domain=acme.mx');
    });
    test('check domain availability throws when params are not array', function () {
        mockResponse('{"available":true}', 200);
        $organizations = test()->facturapi->organizations();

        expect(fn () => $organizations->checkDomainAvailability('invalid'))
            ->toThrow(\Facturapi\Exceptions\FacturapiException::class, 'checkDomainAvailability expects $query to be an array.');
    });

});
