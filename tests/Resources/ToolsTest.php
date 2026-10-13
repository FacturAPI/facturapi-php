<?php

declare(strict_types=1);


describe('Tools', function () {
    test('validateTaxId sends get request with tax_id', function () {
        mockResponse('{"is_valid":true}', 200);
        $tools = test()->facturapi->tools();

        $result = $tools->validateTaxId('ABC010101XYZ');

        expect($result->is_valid)->toBeTrue();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect(urldecode((string) $request->getUri()))->toBe('https://www.facturapi.io/v2/tools/tax_id_validation?tax_id=ABC010101XYZ');
    });

    test('check hits health check endpoint', function () {
        mockResponse('{"ok":true}', 200);
        $tools = test()->facturapi->tools();

        $result = $tools->check();

        expect($result->ok)->toBeTrue();
        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/check');
    });
});
