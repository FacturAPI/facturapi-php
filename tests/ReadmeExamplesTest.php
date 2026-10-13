<?php

declare(strict_types=1);

use Facturapi\Facturapi;
use Facturapi\Models\Customer;
use Facturapi\Tests\TestCase;

uses(TestCase::class);

describe('README Examples', function () {
    it('creates a customer (Quick Start example)', function () {
        // We mock the response to match the OpenAPI Customer schema
        $jsonResponse = '{
            "id": "cus_12345",
            "created_at": "2026-10-11T00:00:00.000Z",
            "livemode": false,
            "email": "walterwhite@gmail.com",
            "legal_name": "Walter White",
            "tax_id": "WIWA761018",
            "tax_system": "601",
            "address": {
                "zip": "06800",
                "street": "Av. de los Rosales",
                "exterior": "123",
                "neighborhood": "Tepito",
                "country": "MEX"
            }
        }';

        mockResponse($jsonResponse);

        $customer = test()->facturapi->customers()->create([
            'email' => 'walterwhite@gmail.com',
            'legal_name' => 'Walter White',
            'tax_id' => 'WIWA761018',
            'address' => [
                'zip' => '06800',
                'street' => 'Av. de los Rosales',
                'exterior' => '123',
                'neighborhood' => 'Tepito',
            ],
        ]);

        expect($customer)->toBeInstanceOf(Customer::class)
            ->and($customer->email)->toBe('walterwhite@gmail.com')
            ->and($customer->legal_name)->toBe('Walter White')
            ->and($customer->tax_id)->toBe('WIWA761018')
            ->and($customer->address['zip'])->toBe('06800');
    });

    it('can be configured with custom options (Client Configuration example)', function () {
        $facturapi = new Facturapi('fake_key', [
            'apiVersion' => 'v2',
            'timeout' => 420,
        ]);

        expect($facturapi)->toBeInstanceOf(Facturapi::class);
    });
});
