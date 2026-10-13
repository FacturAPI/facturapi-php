<?php

declare(strict_types=1);
use Facturapi\Exceptions\FacturapiException;

describe('ErrorHandlingNonJsonEdgeCases', function () {
    test('invalid json error body preserves raw body', function () {
        $rawBody = '{"message": "broken"';

        mockResponse($rawBody, 500, ['Content-Type' => 'application/json']);

        $invoices = test()->facturapi->invoices();

        expect(fn () => $invoices->create(['customer' => []]))
            ->toThrow(function (FacturapiException $exception) use ($rawBody) {
                expect($exception->getStatusCode())->toBe(500);
                expect($exception->getMessage())->toBe($rawBody);
                expect($exception->getErrorData())->toBeNull();
                expect($exception->getRawBody())->toBe($rawBody);
            });
    });
    test('empty error body is exposed as empty string', function () {
        mockResponse('', 500, ['Content-Type' => 'text/plain']);

        $invoices = test()->facturapi->invoices();

        expect(fn () => $invoices->create(['customer' => []]))
            ->toThrow(function (FacturapiException $exception) {
                expect($exception->getStatusCode())->toBe(500);
                expect($exception->getMessage())->toBe('');
                expect($exception->getErrorData())->toBeNull();
                expect($exception->getRawBody())->toBe('');
            });
    });
    test('plain text error body is preserved', function () {
        $rawBody = 'gateway overloaded, retry later';

        mockResponse($rawBody, 503, ['Content-Type' => 'text/plain']);

        $invoices = test()->facturapi->invoices();

        expect(fn () => $invoices->create(['customer' => []]))
            ->toThrow(function (FacturapiException $exception) use ($rawBody) {
                expect($exception->getStatusCode())->toBe(503);
                expect($exception->getMessage())->toBe($rawBody);
                expect($exception->getErrorData())->toBeNull();
                expect($exception->getRawBody())->toBe($rawBody);
            });
    });

});
