# Facturapi PHP SDK

Official PHP SDK for [Facturapi](https://www.facturapi.io).

Language: English | [Español](./README.es.md)

[![Latest Version](https://img.shields.io/packagist/v/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![PHP Version](https://img.shields.io/packagist/php-v/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![Total Downloads](https://img.shields.io/packagist/dt/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![Monthly Downloads](https://img.shields.io/packagist/dm/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![License](https://img.shields.io/packagist/l/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)

## Installation ⚡

```bash
composer require facturapi/facturapi-php
```

Requirements:
- PHP `>=8.2`

## Quick Start 🚀

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Facturapi\Facturapi;

$apiKey = getenv('FACTURAPI_KEY') ?: 'YOUR_API_KEY';
$facturapi = new Facturapi($apiKey);

$customer = $facturapi->Customers->create([
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
```

## Client Configuration ⚙️

Constructor signature:

```php
new Facturapi(string $apiKey, ?array $config = null)
```

Supported config keys:
- `apiVersion` (`string`, default: `v2`)
- `timeout` (`int|float`, default: `360` seconds)
- `httpClient` (`Psr\Http\Client\ClientInterface`, advanced)

Example:

```php
use Facturapi\Facturapi;

$facturapi = new Facturapi($apiKey, [
  'apiVersion' => 'v2',
  'timeout' => 420,
]);
```

### Custom HTTP Client (Advanced)

The SDK works out of the box with its internal Guzzle-based client.

If you provide `httpClient`, pass any PSR-18 compatible client and configure its timeout values in that client:

```php
use Facturapi\Facturapi;
use GuzzleHttp\Client;

$httpClient = new Client([
  'timeout' => 420,
]);

$facturapi = new Facturapi($apiKey, [
  'httpClient' => $httpClient,
]);
```

## Common Usage 🧾

### Create a Product

```php
$product = $facturapi->Products->create([
  'product_key' => '4319150114',
  'description' => 'Apple iPhone 8',
  'price' => 345.60,
]);
```

### Create an Invoice

```php
$invoice = $facturapi->Invoices->create([
  'customer' => 'YOUR_CUSTOMER_ID',
  'items' => [[
    'quantity' => 1,
    'product' => 'YOUR_PRODUCT_ID',
  ]],
  'payment_form' => \Facturapi\PaymentForm::EFECTIVO,
  'folio_number' => '581',
  'series' => 'F',
]);
```

### Download Files

```php
$zipBytes = $facturapi->Invoices->downloadZip('INVOICE_ID');
$pdfBytes = $facturapi->Invoices->downloadPdf('INVOICE_ID');
$xmlBytes = $facturapi->Invoices->downloadXml('INVOICE_ID');
```

`downloadPdf()` returns raw PDF bytes (binary string), not base64.

```php
file_put_contents('invoice.pdf', $pdfBytes);
```

### Send by Email

```php
$facturapi->Invoices->sendByEmail('INVOICE_ID');
```

### Comercio Exterior Catalogs

```php
$results = $facturapi->ComercioExteriorCatalogs->searchTariffFractions([
  'q' => '0101',
  'page' => 0,
  'limit' => 10,
]);
```

## Migration Notes (v4) 🔄

- Minimum PHP version is now `>=8.2`.
- Snake_case method aliases are deprecated in v4 and will be removed in v5.
- `Facturapi\\Exceptions\\Facturapi_Exception` is deprecated in v4 and will be removed in v5.
- Use `Facturapi\\Exceptions\\FacturapiException`.

## Documentation 📚

Full docs: [https://docs.facturapi.io](https://docs.facturapi.io)

## Support 💬

- Issues: open a GitHub issue
- Email: `contacto@facturapi.io`
