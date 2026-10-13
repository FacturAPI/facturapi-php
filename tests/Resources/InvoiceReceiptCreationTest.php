<?php

declare(strict_types=1);
use Facturapi\Exceptions\FacturapiException;

describe('InvoiceReceiptCreation', function () {
    test('invoices create sends json body and query params', function () {
        mockResponse('{"id":"inv_123"}', 201);
        $invoices = test()->facturapi->invoices();

        $payload = [
            'customer' => 'cus_123',
            'items' => [['quantity' => 1]],
        ];

        $result = $invoices->create($payload, ['as' => 'draft', 'validate' => true]);

        expect($result->id)->toBe('inv_123');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices?as=draft&validate=true');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');
        expect((string) $request->getBody())->toBe(json_encode($payload));
    });
    test('receipts create sends json body to expected endpoint', function () {
        mockResponse('{"id":"rec_123"}', 201);
        $receipts = test()->facturapi->receipts();

        $payload = [
            'customer' => 'cus_123',
            'items' => [['quantity' => 1]],
        ];

        $result = $receipts->create($payload);

        expect($result->id)->toBe('rec_123');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/receipts');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');
        expect((string) $request->getBody())->toBe(json_encode($payload));
    });
    test('invoices cancel serializes query params without extra slash', function () {
        mockResponse('{"status":"canceled"}', 200);
        $invoices = test()->facturapi->invoices();

        $invoices->cancel('inv_123', ['motive' => '01', 'substitution' => 'inv_456']);

        $request = test()->httpClient->requests()[0];
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/invoices/inv_123?motive=01&substitution=inv_456');
    });
    test('invoices cancel throws on non2xx and preserves error shape', function () {
        $errorBody = [
            'message' => 'Cancellation rejected',
            'code' => 'cancel_error',
            'details' => [
                ['path' => 'motive', 'message' => 'Invalid motive'],
            ],
        ];

        mockResponse(json_encode($errorBody), 409, ['Content-Type' => 'application/json']);
        $invoices = test()->facturapi->invoices();

        expect(fn () => $invoices->cancel('inv_123', ['motive' => '99']))
            ->toThrow(function (FacturapiException $exception) use ($errorBody) {
                expect($exception->getStatusCode())->toBe(409);
                expect($exception->getMessage())->toBe('Cancellation rejected');
                expect($exception->getErrorData())->toBe($errorBody);
            });
    });

});
