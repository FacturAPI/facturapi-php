<?php

declare(strict_types=1);
use Facturapi\Exceptions\FacturapiException;

describe('ErrorHandling', function () {
    test('api error shape is fully available on exception', function () {
        $errorBody = [
            'message' => 'Request validation failed',
            'code' => 'validation_error',
            'path' => 'customer.tax_id',
            'location' => 'body',
            'details' => [
                [
                    'path' => 'customer.tax_id',
                    'message' => 'customer.tax_id must be a valid RFC',
                    'code' => 'invalid_rfc',
                ],
            ],
            'errors' => [
                [
                    'path' => 'customer.tax_id',
                    'location' => 'body',
                    'message' => 'customer.tax_id must be a valid RFC',
                    'code' => 'invalid_rfc',
                ],
            ],
        ];

        mockResponse(json_encode($errorBody), 422, [
                'Content-Type' => 'application/json',
                'Retry-After' => '3',
                'x-facturapi-log-id' => 'log_123',
            ]);

        $invoices = test()->facturapi->invoices();

        expect(fn () => $invoices->create(['customer' => []]))
            ->toThrow(function (FacturapiException $exception) use ($errorBody) {
                expect($exception->getStatusCode())->toBe(422);
                expect($exception->getMessage())->toBe('Request validation failed');
                expect($exception->getErrorData())->toBe($errorBody);
                expect($exception->getResponseData())->toBe($errorBody);
                expect($exception->getRawBody())->toBe(json_encode($errorBody));

                expect($exception->getErrorData()['code'])->toBe('validation_error');
                expect($exception->getErrorCode())->toBe('validation_error');
                expect($exception->getErrorPath())->toBe('customer.tax_id');
                expect($exception->getErrorLocation())->toBe('body');
                expect($exception->getErrors())->toBe($errorBody['errors']);
                expect($exception->getLogId())->toBe('log_123');
                expect($exception->getResponseHeaders()['retry-after'])->toBe('3');
                expect($exception->getResponseHeaders()['x-facturapi-log-id'])->toBe('log_123');
                expect($exception->getErrorData()['details'][0]['path'])->toBe('customer.tax_id');
                expect($exception->getErrorData()['details'][0]['code'])->toBe('invalid_rfc');
            });
    });
    test('non json errors still expose raw body', function () {
        $rawBody = '<html><body>502 Bad Gateway</body></html>';

        mockResponse($rawBody, 502, ['Content-Type' => 'text/html']);

        $invoices = test()->facturapi->invoices();

        expect(fn () => $invoices->create(['customer' => []]))
            ->toThrow(function (FacturapiException $exception) use ($rawBody) {
                expect($exception->getStatusCode())->toBe(502);
                expect($exception->getMessage())->toBe($rawBody);
                expect($exception->getErrorData())->toBeNull();
                expect($exception->getRawBody())->toBe($rawBody);
            });
    });
    test('numeric api error codes are converted to strings', function () {
        mockResponse('{"code": 400}', 400, ['Content-Type' => 'application/json']);

        $invoices = test()->facturapi->invoices();

        expect(fn () => $invoices->create(['customer' => []]))
            ->toThrow(function (FacturapiException $exception) {
                expect($exception->getErrorCode())->toBe('400');
            });
    });

});
