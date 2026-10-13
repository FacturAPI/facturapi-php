<?php

declare(strict_types=1);

use Facturapi\Exceptions\NotFoundException;
use Facturapi\Exceptions\ValidationException;
use Facturapi\Models\BaseTax;
use Facturapi\Models\IepsTax;
use Facturapi\Models\LocalTax;
use Facturapi\Models\Product;
use Facturapi\Models\ProductSearchResult;

describe('Products', function () {
    test('create sends full json body with all required and optional properties', function () {
        $responseBody = [
            'id' => 'prod_123',
            'created_at' => '2025-01-15T10:30:00.000Z',
            'livemode' => false,
            'description' => 'Guitarra electroacústica Fender',
            'product_key' => '60131324',
            'price' => 12500.50,
            'tax_included' => true,
            'taxability' => '02',
            'taxes' => [
                [
                    'type' => 'IVA',
                    'rate' => 0.16,
                    'base' => 12500.50,
                    'factor' => 'Tasa',
                    'withholding' => false,
                ],
                [
                    'type' => 'IEPS',
                    'rate' => 0.08,
                    'base' => 12500.50,
                    'factor' => 'Tasa',
                    'withholding' => false,
                    'ieps_mode' => 'sum_before_taxes',
                ],
            ],
            'local_taxes' => [
                [
                    'type' => 'ISH',
                    'rate' => 0.03,
                    'base' => 12500.50,
                    'withholding' => false,
                ],
            ],
            'unit_key' => 'H87',
            'unit_name' => 'Pieza',
            'sku' => 'FEN-GTR-001',
        ];

        mockResponse((string) json_encode($responseBody), 201);
        $products = test()->facturapi->products();

        $payload = [
            'description' => 'Guitarra electroacústica Fender',
            'product_key' => '60131324',
            'price' => 12500.50,
            'tax_included' => true,
            'taxability' => '02',
            'taxes' => [
                [
                    'type' => 'IVA',
                    'rate' => 0.16,
                    'base' => 12500.50,
                    'factor' => 'Tasa',
                    'withholding' => false,
                ],
                [
                    'type' => 'IEPS',
                    'rate' => 0.08,
                    'base' => 12500.50,
                    'factor' => 'Tasa',
                    'withholding' => false,
                    'ieps_mode' => 'sum_before_taxes',
                ],
            ],
            'local_taxes' => [
                [
                    'type' => 'ISH',
                    'rate' => 0.03,
                    'base' => 12500.50,
                    'withholding' => false,
                ],
            ],
            'unit_key' => 'H87',
            'unit_name' => 'Pieza',
            'sku' => 'FEN-GTR-001',
        ];

        $result = $products->create($payload);

        expect($result)->toBeInstanceOf(Product::class);
        expect($result->id)->toBe('prod_123');
        expect($result->created_at)->toBe('2025-01-15T10:30:00.000Z');
        expect($result->livemode)->toBeFalse();
        expect($result->description)->toBe('Guitarra electroacústica Fender');
        expect($result->product_key)->toBe('60131324');
        expect($result->price)->toBe(12500.50);
        expect($result->tax_included)->toBeTrue();
        expect($result->taxability)->toBe('02');
        expect($result->unit_key)->toBe('H87');
        expect($result->unit_name)->toBe('Pieza');
        expect($result->sku)->toBe('FEN-GTR-001');

        expect($result->taxes)->toBeArray()->toHaveCount(2);
        expect($result->taxes[0])->toBeInstanceOf(BaseTax::class);
        expect($result->taxes[0]->type)->toBe('IVA');
        expect($result->taxes[0]->rate)->toBe(0.16);
        expect($result->taxes[0]->base)->toBe(12500.50);
        expect($result->taxes[0]->factor)->toBe('Tasa');
        expect($result->taxes[0]->withholding)->toBeFalse();

        expect($result->taxes[1])->toBeInstanceOf(BaseTax::class);
        expect($result->taxes[1])->toBeInstanceOf(IepsTax::class);
        expect($result->taxes[1]->type)->toBe('IEPS');
        expect($result->taxes[1]->rate)->toBe(0.08);
        expect($result->taxes[1]->base)->toBe(12500.50);
        expect($result->taxes[1]->factor)->toBe('Tasa');
        expect($result->taxes[1]->withholding)->toBeFalse();
        expect($result->taxes[1]->ieps_mode)->toBe('sum_before_taxes');

        expect($result->local_taxes)->toBeArray()->toHaveCount(1);
        expect($result->local_taxes[0])->toBeInstanceOf(LocalTax::class);
        expect($result->local_taxes[0]->type)->toBe('ISH');
        expect($result->local_taxes[0]->rate)->toBe(0.03);
        expect($result->local_taxes[0]->base)->toBe(12500.50);
        expect($result->local_taxes[0]->withholding)->toBeFalse();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/products');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');

        $sentPayload = json_decode((string) $request->getBody(), true);
        expect($sentPayload)->toBe($payload);
    });

    test('create sends json body with minimal required fields', function () {
        $responseBody = [
            'id' => 'prod_min_123',
            'created_at' => '2025-01-15T11:00:00.000Z',
            'livemode' => false,
            'description' => 'Servicio de desarrollo',
            'product_key' => '84111506',
            'price' => 5000.50,
            'unit_key' => 'E48',
        ];

        mockResponse((string) json_encode($responseBody), 201);
        $products = test()->facturapi->products();

        $payload = [
            'description' => 'Servicio de desarrollo',
            'product_key' => '84111506',
            'price' => 5000.50,
            'unit_key' => 'E48',
        ];

        $result = $products->create($payload);

        expect($result)->toBeInstanceOf(Product::class);
        expect($result->id)->toBe('prod_min_123');
        expect($result->description)->toBe('Servicio de desarrollo');
        expect($result->product_key)->toBe('84111506');
        expect($result->price)->toBe(5000.50);
        expect($result->unit_key)->toBe('E48');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('POST');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/products');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');

        $sentPayload = json_decode((string) $request->getBody(), true);
        expect($sentPayload)->toBe($payload);
    });

    test('retrieve fetches a single product by id', function () {
        $responseBody = [
            'id' => 'prod_123',
            'created_at' => '2025-01-15T10:30:00.000Z',
            'livemode' => false,
            'description' => 'Guitarra electroacústica Fender',
            'product_key' => '60131324',
            'price' => 12500.50,
            'tax_included' => true,
            'taxability' => '02',
            'taxes' => [
                [
                    'type' => 'IVA',
                    'rate' => 0.16,
                    'base' => 12500.50,
                    'factor' => 'Tasa',
                    'withholding' => false,
                ],
            ],
            'local_taxes' => [],
            'unit_key' => 'H87',
            'unit_name' => 'Pieza',
            'sku' => 'FEN-GTR-001',
        ];

        mockResponse((string) json_encode($responseBody), 200);
        $products = test()->facturapi->products();

        $result = $products->retrieve('prod_123');

        expect($result)->toBeInstanceOf(Product::class);
        expect($result->id)->toBe('prod_123');
        expect($result->created_at)->toBe('2025-01-15T10:30:00.000Z');
        expect($result->livemode)->toBeFalse();
        expect($result->description)->toBe('Guitarra electroacústica Fender');
        expect($result->product_key)->toBe('60131324');
        expect($result->price)->toBe(12500.50);
        expect($result->tax_included)->toBeTrue();
        expect($result->taxability)->toBe('02');
        expect($result->unit_key)->toBe('H87');
        expect($result->unit_name)->toBe('Pieza');
        expect($result->sku)->toBe('FEN-GTR-001');
        expect($result->taxes)->toBeArray()->toHaveCount(1);
        expect($result->taxes[0]->type)->toBe('IVA');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/products/prod_123');
    });

    test('update sends put request with all properties', function () {
        $responseBody = [
            'id' => 'prod_123',
            'created_at' => '2025-01-15T10:30:00.000Z',
            'livemode' => false,
            'description' => 'Guitarra Fender Stratocaster Custom',
            'product_key' => '60131324',
            'price' => 18999.99,
            'tax_included' => false,
            'taxability' => '02',
            'taxes' => [
                [
                    'type' => 'IVA',
                    'rate' => 0.16,
                    'base' => 18999.99,
                    'factor' => 'Tasa',
                    'withholding' => false,
                ],
                [
                    'type' => 'ISR',
                    'rate' => 0.10,
                    'base' => 18999.99,
                    'factor' => 'Tasa',
                    'withholding' => true,
                ],
            ],
            'local_taxes' => [
                [
                    'type' => 'ISH',
                    'rate' => 0.04,
                    'base' => 18999.99,
                    'withholding' => false,
                ],
            ],
            'unit_key' => 'H87',
            'unit_name' => 'Pieza',
            'sku' => 'FEN-GTR-002',
        ];

        mockResponse((string) json_encode($responseBody), 200);
        $products = test()->facturapi->products();

        $payload = [
            'description' => 'Guitarra Fender Stratocaster Custom',
            'product_key' => '60131324',
            'price' => 18999.99,
            'tax_included' => false,
            'taxability' => '02',
            'taxes' => [
                [
                    'type' => 'IVA',
                    'rate' => 0.16,
                    'base' => 18999.99,
                    'factor' => 'Tasa',
                    'withholding' => false,
                ],
                [
                    'type' => 'ISR',
                    'rate' => 0.10,
                    'base' => 18999.99,
                    'factor' => 'Tasa',
                    'withholding' => true,
                ],
            ],
            'local_taxes' => [
                [
                    'type' => 'ISH',
                    'rate' => 0.04,
                    'base' => 18999.99,
                    'withholding' => false,
                ],
            ],
            'unit_key' => 'H87',
            'unit_name' => 'Pieza',
            'sku' => 'FEN-GTR-002',
        ];

        $result = $products->update('prod_123', $payload);

        expect($result)->toBeInstanceOf(Product::class);
        expect($result->id)->toBe('prod_123');
        expect($result->description)->toBe('Guitarra Fender Stratocaster Custom');
        expect($result->price)->toBe(18999.99);
        expect($result->tax_included)->toBeFalse();
        expect($result->sku)->toBe('FEN-GTR-002');
        expect($result->taxes)->toBeArray()->toHaveCount(2);
        expect($result->taxes[0]->type)->toBe('IVA');
        expect($result->taxes[1]->type)->toBe('ISR');
        expect($result->taxes[1]->withholding)->toBeTrue();
        expect($result->local_taxes)->toBeArray()->toHaveCount(1);
        expect($result->local_taxes[0]->rate)->toBe(0.04);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/products/prod_123');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');

        $sentPayload = json_decode((string) $request->getBody(), true);
        expect($sentPayload)->toBe($payload);
    });

    test('update sends partial payload for editing specific product attributes', function () {
        $responseBody = [
            'id' => 'prod_123',
            'created_at' => '2025-01-15T10:30:00.000Z',
            'livemode' => false,
            'description' => 'Guitarra Fender Stratocaster Edición 2025',
            'product_key' => '60131324',
            'price' => 19500.50,
            'unit_key' => 'H87',
        ];

        mockResponse((string) json_encode($responseBody), 200);
        $products = test()->facturapi->products();

        $payload = [
            'description' => 'Guitarra Fender Stratocaster Edición 2025',
            'price' => 19500.50,
        ];

        $result = $products->update('prod_123', $payload);

        expect($result)->toBeInstanceOf(Product::class);
        expect($result->id)->toBe('prod_123');
        expect($result->description)->toBe('Guitarra Fender Stratocaster Edición 2025');
        expect($result->price)->toBe(19500.50);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('PUT');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/products/prod_123');
        expect($request->getHeaderLine('Content-Type'))->toBe('application/json');

        $sentPayload = json_decode((string) $request->getBody(), true);
        expect($sentPayload)->toBe($payload);
    });

    test('delete removes a product by id', function () {
        $responseBody = [
            'id' => 'prod_123',
            'created_at' => '2025-01-15T10:30:00.000Z',
            'livemode' => false,
            'description' => 'Guitarra electroacústica Fender',
            'product_key' => '60131324',
            'price' => 12500.50,
            'unit_key' => 'H87',
        ];

        mockResponse((string) json_encode($responseBody), 200);
        $products = test()->facturapi->products();

        $result = $products->delete('prod_123');

        expect($result)->toBeInstanceOf(Product::class);
        expect($result->id)->toBe('prod_123');

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('DELETE');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/products/prod_123');
    });

    test('all retrieves paginated list of products without parameters', function () {
        $responseBody = [
            'page' => 1,
            'total_pages' => 1,
            'total_results' => 1,
            'data' => [
                [
                    'id' => 'prod_1',
                    'created_at' => '2025-01-01T00:00:00.000Z',
                    'livemode' => false,
                    'description' => 'Producto 1',
                    'product_key' => '01010101',
                    'price' => 100.0,
                    'unit_key' => 'H87',
                ],
            ],
        ];

        mockResponse((string) json_encode($responseBody), 200);
        $products = test()->facturapi->products();

        $result = $products->all();

        expect($result)->toBeInstanceOf(ProductSearchResult::class);
        expect($result->page)->toBe(1);
        expect($result->total_pages)->toBe(1);
        expect($result->total_results)->toBe(1);
        expect($result->data)->toBeArray()->toHaveCount(1);
        expect($result->data[0])->toBeInstanceOf(Product::class);
        expect($result->data[0]->id)->toBe('prod_1');
        expect($result->data[0]->description)->toBe('Producto 1');
        expect($result->data[0]->price)->toBe(100.0);

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect((string) $request->getUri())->toBe('https://www.facturapi.io/v2/products');
    });

    test('all serializes query filters for search, sku, pagination, and date ranges', function () {
        mockResponse('{"page":2,"total_pages":5,"total_results":120,"data":[]}', 200);
        $products = test()->facturapi->products();

        $filters = [
            'q' => 'laptop',
            'sku' => 'SKU-LAP-001',
            'page' => 2,
            'limit' => 25,
            'date' => [
                'gt' => '2025-01-01',
                'gte' => '2025-01-02',
                'lt' => '2025-12-31',
                'lte' => '2025-12-30',
            ],
        ];

        $result = $products->all($filters);

        expect($result)->toBeInstanceOf(ProductSearchResult::class);
        expect($result->page)->toBe(2);
        expect($result->total_pages)->toBe(5);
        expect($result->total_results)->toBe(120);
        expect($result->data)->toBeArray()->toBeEmpty();

        $request = test()->httpClient->requests()[0];
        expect($request->getMethod())->toBe('GET');
        expect(urldecode($request->getUri()->getQuery()))->toBe('q=laptop&sku=SKU-LAP-001&page=2&limit=25&date[gt]=2025-01-01&date[gte]=2025-01-02&date[lt]=2025-12-31&date[lte]=2025-12-30');
    });

    test('retrieve throws NotFoundException when product is not found', function () {
        $errorBody = [
            'message' => 'Product not found',
        ];

        mockResponse((string) json_encode($errorBody), 404, ['Content-Type' => 'application/json']);
        $products = test()->facturapi->products();

        expect(fn () => $products->retrieve('prod_nonexistent'))
            ->toThrow(function (NotFoundException $exception) {
                expect($exception->getStatusCode())->toBe(404);
                expect($exception->getMessage())->toBe('Product not found');
            });
    });

    test('create throws ValidationException on invalid request payload', function () {
        $errorBody = [
            'message' => 'Validation Error: price is required',
        ];

        mockResponse((string) json_encode($errorBody), 400, ['Content-Type' => 'application/json']);
        $products = test()->facturapi->products();

        expect(fn () => $products->create(['description' => 'Incomplete product']))
            ->toThrow(function (ValidationException $exception) {
                expect($exception->getStatusCode())->toBe(400);
                expect($exception->getMessage())->toBe('Validation Error: price is required');
            });
    });

    test('delete throws NotFoundException when deleting non-existent product', function () {
        $errorBody = [
            'message' => 'Product not found',
        ];

        mockResponse((string) json_encode($errorBody), 404, ['Content-Type' => 'application/json']);
        $products = test()->facturapi->products();

        expect(fn () => $products->delete('prod_nonexistent'))
            ->toThrow(function (NotFoundException $exception) {
                expect($exception->getStatusCode())->toBe(404);
                expect($exception->getMessage())->toBe('Product not found');
            });
    });
});
