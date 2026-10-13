# Facturapi PHP SDK

Official PHP SDK for [Facturapi](https://www.facturapi.io).

Language: English | [Español](./README.es.md)

[![Latest Version](https://img.shields.io/packagist/v/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![PHP Version](https://img.shields.io/packagist/php-v/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![Total Downloads](https://img.shields.io/packagist/dt/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![License](https://img.shields.io/packagist/l/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)

## Compatibility ✅

- **PHP**: `>= 8.2`
- **PSR-18 HTTP Client**: Fully compatible (automatically discovered via `php-http/discovery`).
- **Long-Running Processes**: 100% compatible with application servers like **FrankenPHP**, **RoadRunner**, and **Swoole** (e.g., Laravel Octane). The SDK is stateless and does not introduce memory leaks.

## Developer Experience ✨

Version 5 introduces **Strictly Typed DTOs (Data Transfer Objects)**. 
Instead of guessing array keys, your IDE will now provide full autocompletion (IntelliSense) for all API responses, making development faster and significantly reducing typos.

```php
// ❌ v4 (Generic Arrays - No autocompletion)
echo $customer['legal_name']; 

// ✅ v5 (Typed DTOs - Full IDE Autocompletion)
echo $customer->legal_name; 
```

### Enums Support
The SDK ships with PHP Enums for common catalogs (e.g., `PaymentForm`, `TaxType`). **Using them is completely optional** (you can still pass raw strings like `'01'`), but they are highly recommended. Enums not only power IDE autocompletion and prevent typos, but they also give clear context to AI assistants (LLMs) about what values can be safely injected into the payload.

```php
// ✅ Optional but recommended (IDE & AI friendly)
'payment_form' => \Facturapi\PaymentForm::EFECTIVO,

// 🆗 Also valid
'payment_form' => '01',
```

## Installation ⚡

```bash
composer require facturapi/facturapi-php
```

Without Composer:

1. Download `facturapi-php-standalone.zip` from the [Latest Release](https://github.com/facturapi/facturapi-php/releases/latest).
2. Extract it in your project.
3. Require the bundled autoloader:

```php
require_once __DIR__ . '/path/to/extracted-folder/autoload.php';
```

## Client Configuration ⚙️

Initialize the SDK by passing your API Key. 

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Facturapi\Facturapi;

$apiKey = getenv('FACTURAPI_KEY') ?: 'YOUR_API_KEY';
$facturapi = new Facturapi($apiKey);
```

You can optionally pass a configuration array as the second argument:

```php
$facturapi = new Facturapi($apiKey, [
  'apiVersion' => 'v2',
  'timeout' => 360, // seconds
]);
```

### Custom HTTP Client (Advanced)

The SDK works out of the box with its internal Guzzle-based client. If you wish to provide your own PSR-18 compatible client (e.g. to configure proxy settings or custom timeouts):

```php
use Facturapi\Facturapi;
use GuzzleHttp\Client;

$httpClient = new Client(['timeout' => 420]);

$facturapi = new Facturapi($apiKey, [
  'httpClient' => $httpClient,
]);
```

## Framework Integration Examples 📚

Check out our official guides for integrating Facturapi with popular PHP frameworks using dependency injection and best practices:

- [Laravel Integration](./docs/laravel.md)
- [Symfony Integration](./docs/symfony.md)
- [CodeIgniter 4 Integration](./docs/codeigniter.md)

---

## Core Usage 🧾

### 1. Invoices

**Create an Invoice**
```php
$invoice = $facturapi->invoices()->create([
  'customer' => 'YOUR_CUSTOMER_ID',
  'items' => [[
    'quantity' => 1,
    'product' => 'YOUR_PRODUCT_ID',
  ]],
  'payment_form' => \Facturapi\PaymentForm::EFECTIVO,
  'folio_number' => '581',
  'series' => 'F',
]);

echo "Created invoice: " . $invoice->id;
```

**Download Invoice Files**
```php
$zipBytes = $facturapi->invoices()->downloadZip('INVOICE_ID');
$pdfBytes = $facturapi->invoices()->downloadPdf('INVOICE_ID'); // Returns raw binary string
$xmlBytes = $facturapi->invoices()->downloadXml('INVOICE_ID');

file_put_contents('invoice.pdf', $pdfBytes);
```

**Send by Email**
```php
$facturapi->invoices()->sendByEmail('INVOICE_ID');
```

### 2. Customers

**Create a Customer**
```php
$customer = $facturapi->customers()->create([
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

### 3. Products

**Create a Product**
```php
$product = $facturapi->products()->create([
  'product_key' => '4319150114',
  'description' => 'Apple iPhone 8',
  'price' => 345.60,
]);
```

### 4. Organizations & Catalogs

**Set Default Series for an Organization**
```php
$result = $facturapi->organizations()->updateDefaultSeries(
  'ORGANIZATION_ID',
  [
    'type' => 'I',
    'series' => 'A',
  ]
);
```

**Search Catalogs**
```php
// Comercio Exterior
$results = $facturapi->comercioExteriorCatalogs()->searchTariffFractions([
  'q' => '0101',
  'page' => 0,
  'limit' => 10,
]);

// Payroll / Nómina
$deductions = $facturapi->nominaCatalogs()->searchDeductions(["q" => "001"]);
$perceptions = $facturapi->nominaCatalogs()->searchPerceptions(["q" => "001"]);
```

### 5. Webhooks

**Validate Signature**
To validate an incoming webhook signature locally using the SDK, store your webhook secret in your environment variables (e.g. `FACTURAPI_WEBHOOK_SECRET`) and pass the raw body, signature header, and secret to the `validateSignature` method:

```php
$rawBody = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_SIGNATURE'] ?? '';
$webhookSecret = getenv('FACTURAPI_WEBHOOK_SECRET');

$result = $facturapi->webhooks()->validateSignature([
  'body' => $rawBody,
  'signature' => $signature,
  'webhookSecret' => $webhookSecret,
]);

if (!$result['valid']) {
    // Handle invalid signature
}
```

---

## Error Handling ⚠️

On non-2xx responses, the SDK throws `Facturapi\Exceptions\FacturapiException`.

The exception includes:
- `getMessage()`: API error message when present.
- `getStatusCode()`: HTTP status code.
- `getErrorData()`: decoded JSON error payload (full API shape).
- `getRawBody()`: raw response body string.

```php
use Facturapi\Exceptions\FacturapiException;

try {
  $facturapi->invoices()->create($payload);
} catch (FacturapiException $e) {
  $status = $e->getStatusCode();
  $error = $e->getErrorData(); // Full API error shape when body is valid JSON.
  $firstDetail = $error['details'][0] ?? null; // e.g. ['path' => 'items.0.quantity', 'message' => '...', 'code' => '...']
}
```

---

## Migrating from v4 to v5 🔄

Version 5 introduces several breaking changes designed to make the SDK safer and more modern:

1. **Strictly Typed DTOs**: All API resources now return strictly typed Data Transfer Objects (DTOs) and Enums instead of generic associative arrays.
    - **v4 syntax:** `$customer['legal_name']`
    - **v5 syntax:** `$customer->legal_name`
2. **Resource Methods**: API resources are now accessed via methods instead of properties.
    - **v4 syntax:** `$facturapi->Customers`
    - **v5 syntax:** `$facturapi->customers()`
3. **PHP 8.2+ Required**: Ensure your server is running PHP 8.2 or higher.
4. **HTTP Client Upgrade**: The internal HTTP client implementation has been updated. The SDK remains PSR-18 compliant and will automatically discover installed clients via `php-http/discovery`.
5. **Removed Features**: 
   - Removed support for the positional `apiVersion` constructor argument.
   - Snake_case method aliases have been removed.
   - `Facturapi\Exceptions\Facturapi_Exception` has been removed (Use `Facturapi\Exceptions\FacturapiException`).

*(Note: Composer projects require no autoloader changes. Non-Composer projects should download the v5 `.zip` release and require the bundled `autoload.php` as usual).*

If you are not ready to upgrade, you can pin your dependency to `^4.8`.

---

## Documentation 📚

Full docs: [https://docs.facturapi.io](https://docs.facturapi.io)

## Support 💬

- Issues: open a GitHub issue
- Email: `contacto@facturapi.io`
