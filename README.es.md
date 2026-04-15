# Facturapi PHP SDK

SDK oficial de PHP para [Facturapi](https://www.facturapi.io).

Idioma: Español | [English](./README.md)

[![Última Versión](https://img.shields.io/packagist/v/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![Versión de PHP](https://img.shields.io/packagist/php-v/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![Descargas Totales](https://img.shields.io/packagist/dt/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![Licencia](https://img.shields.io/packagist/l/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)

## Instalación ⚡

```bash
composer require facturapi/facturapi-php
```

Sin Composer (workaround soportado):

```php
require_once __DIR__ . '/path/to/facturapi-php/src/Facturapi.php';
```

Requisitos:
- PHP `>=8.2`

## Compatibilidad con Versiones Anteriores de PHP

Desde la versión **4.0.0**, el SDK requiere **PHP >= 8.2**.

- Si tu proyecto ya usa PHP 8.2+, no necesitas cambios adicionales.
- Si tu proyecto está en PHP 8.1 o menor, fija la versión **3.7.0** (última release compatible antes del requisito de PHP 8.2).

## Inicio Rápido 🚀

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

## Configuración del Cliente ⚙️

Firma del constructor:

```php
new Facturapi(string $apiKey, ?array $config = null)
```

Claves soportadas en `config`:
- `apiVersion` (`string`, valor por defecto: `v2`)
- `timeout` (`int|float`, valor por defecto: `360` segundos)
- `httpClient` (`Psr\Http\Client\ClientInterface`, avanzado)

Ejemplo:

```php
use Facturapi\Facturapi;

$facturapi = new Facturapi($apiKey, [
  'apiVersion' => 'v2',
  'timeout' => 420,
]);
```

### Cliente HTTP Personalizado (Avanzado)

El SDK funciona sin configuración adicional con su cliente interno basado en Guzzle.

Si proporcionas `httpClient`, puedes pasar cualquier cliente compatible con PSR-18 y configurar ahí mismo los timeouts:

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

## Uso Común 🧾

### Crear un Producto

```php
$product = $facturapi->Products->create([
  'product_key' => '4319150114',
  'description' => 'Apple iPhone 8',
  'price' => 345.60,
]);
```

### Crear una Factura

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

### Descargar Archivos

```php
$zipBytes = $facturapi->Invoices->downloadZip('INVOICE_ID');
$pdfBytes = $facturapi->Invoices->downloadPdf('INVOICE_ID');
$xmlBytes = $facturapi->Invoices->downloadXml('INVOICE_ID');
```

`downloadPdf()` devuelve bytes crudos de PDF (cadena binaria), no base64.

```php
file_put_contents('invoice.pdf', $pdfBytes);
```

### Enviar por Correo

```php
$facturapi->Invoices->sendByEmail('INVOICE_ID');
```

### Catálogos de Comercio Exterior

```php
$results = $facturapi->ComercioExteriorCatalogs->searchTariffFractions([
  'q' => '0101',
  'page' => 0,
  'limit' => 10,
]);
```

### Organizaciones: Definir Serie Por Defecto

```php
$result = $facturapi->Organizations->updateDefaultSeries(
  'ORGANIZATION_ID',
  [
    'type' => 'I',
    'series' => 'A',
  ]
);
```

## Manejo de Errores ⚠️

En respuestas no-2xx, el SDK lanza `Facturapi\Exceptions\FacturapiException`.

La excepción incluye:
- `getMessage()`: mensaje del API cuando está disponible.
- `getStatusCode()`: código HTTP.
- `getErrorData()`: payload JSON decodificado del error (shape completo del API).
- `getRawBody()`: cuerpo crudo de la respuesta.

```php
use Facturapi\Exceptions\FacturapiException;

try {
  $facturapi->Invoices->create($payload);
} catch (FacturapiException $e) {
  $status = $e->getStatusCode();
  $error = $e->getErrorData(); // Shape completo del error del API cuando el body es JSON válido.
  $firstDetail = $error['details'][0] ?? null; // p.ej. ['path' => 'items.0.quantity', 'message' => '...', 'code' => '...']
}
```

## Notas de Migración (v4) 🔄

- La versión mínima de PHP ahora es `>=8.2`.
- Se eliminó el soporte para el argumento posicional `apiVersion` en el constructor.
- Proyectos con Composer: no requieren cambios de carga; continúen usando `vendor/autoload.php`.
- Proyectos sin Composer pueden seguir usando el SDK cargando `src/Facturapi.php` directamente.
- Los aliases snake_case están deprecados en v4 y se eliminarán en v5.
- `Facturapi\\Exceptions\\Facturapi_Exception` está deprecada en v4 y se eliminará en v5.
- Usa `Facturapi\\Exceptions\\FacturapiException`.

## Documentación 📚

Documentación completa: [https://docs.facturapi.io](https://docs.facturapi.io)

## Soporte 💬

- Issues: abre un issue en GitHub
- Email: `contacto@facturapi.io`
