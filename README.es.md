# Facturapi PHP SDK

SDK oficial de PHP para [Facturapi](https://www.facturapi.io).

Idioma: Español | [English](./README.md)

[![Última Versión](https://img.shields.io/packagist/v/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![Versión de PHP](https://img.shields.io/packagist/php-v/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![Descargas Totales](https://img.shields.io/packagist/dt/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)
[![Licencia](https://img.shields.io/packagist/l/facturapi/facturapi-php?style=flat-square)](https://packagist.org/packages/facturapi/facturapi-php)

## Compatibilidad ✅

- **PHP**: `>= 8.2`
- **Cliente HTTP PSR-18**: Totalmente compatible (se descubre automáticamente usando `php-http/discovery`).
- **Procesos de Larga Duración**: 100% compatible con servidores de aplicaciones como **FrankenPHP**, **RoadRunner** y **Swoole** (ej. Laravel Octane). El SDK no mantiene estado, por lo que es seguro y no introduce memory leaks.

## Experiencia de Desarrollo (DX) ✨

La versión 5 introduce **DTOs (Data Transfer Objects) Estrictamente Tipados**.
En lugar de tener que adivinar las llaves de un arreglo, tu IDE ahora te ofrecerá autocompletado total (IntelliSense) para todas las respuestas de la API, haciendo el desarrollo más rápido y reduciendo significativamente los errores tipográficos.

```php
// ❌ v4 (Arreglos Genéricos - Sin autocompletado)
echo $customer['legal_name']; 

// ✅ v5 (DTOs Tipados - Autocompletado total en el IDE)
echo $customer->legal_name; 
```

### Soporte de Enums
El SDK incluye PHP Enums para catálogos comunes (ej. `PaymentForm`, `TaxType`). **Su uso es completamente opcional** (puedes seguir pasando strings crudos como `'01'`), pero son altamente recomendados. Los Enums no solo habilitan el autocompletado en el IDE y previenen errores de escritura, sino que también le dan contexto claro a los asistentes de IA (LLMs) sobre qué valores son válidos para inyectar en las peticiones.

```php
// ✅ Opcional pero recomendado (Amigable para IDEs e IA)
'payment_form' => \Facturapi\PaymentForm::EFECTIVO,

// 🆗 También válido
'payment_form' => '01',
```

## Instalación ⚡

```bash
composer require facturapi/facturapi-php
```

Sin Composer:

1. Descarga el archivo `facturapi-php-standalone.zip` desde el [Último Release](https://github.com/facturapi/facturapi-php/releases/latest).
2. Extráelo en tu proyecto.
3. Importa el autoloader incluido:

```php
require_once __DIR__ . '/ruta/a/la/carpeta/extraida/autoload.php';
```

## Configuración del Cliente ⚙️

Inicializa el SDK pasando tu API Key.

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Facturapi\Facturapi;

$apiKey = getenv('FACTURAPI_KEY') ?: 'TU_API_KEY';
$facturapi = new Facturapi($apiKey);
```

Opcionalmente, puedes pasar un arreglo de configuración como segundo argumento:

```php
$facturapi = new Facturapi($apiKey, [
  'apiVersion' => 'v2',
  'timeout' => 360, // segundos
]);
```

### Cliente HTTP Personalizado (Avanzado)

El SDK funciona directamente con su cliente interno basado en Guzzle. Si deseas proveer tu propio cliente compatible con PSR-18 (ej. para configurar proxies o timeouts personalizados):

```php
use Facturapi\Facturapi;
use GuzzleHttp\Client;

$httpClient = new Client(['timeout' => 420]);

$facturapi = new Facturapi($apiKey, [
  'httpClient' => $httpClient,
]);
```

## Ejemplos de Integración con Frameworks 📚

Revisa nuestras guías oficiales para integrar Facturapi con los frameworks de PHP más populares usando inyección de dependencias y las mejores prácticas:

- [Integración con Laravel](./docs/laravel.md)
- [Integración con Symfony](./docs/symfony.md)
- [Integración con CodeIgniter 4](./docs/codeigniter.md)

---

## Uso Principal 🧾

### 1. Facturas

**Crear una Factura**
```php
$invoice = $facturapi->invoices()->create([
  'customer' => 'ID_DE_TU_CLIENTE',
  'items' => [[
    'quantity' => 1,
    'product' => 'ID_DE_TU_PRODUCTO',
  ]],
  'payment_form' => \Facturapi\PaymentForm::EFECTIVO,
  'folio_number' => '581',
  'series' => 'F',
]);

echo "Factura creada: " . $invoice->id;
```

**Descargar Archivos de la Factura**
```php
$zipBytes = $facturapi->invoices()->downloadZip('ID_DE_FACTURA');
$pdfBytes = $facturapi->invoices()->downloadPdf('ID_DE_FACTURA'); // Devuelve bytes crudos
$xmlBytes = $facturapi->invoices()->downloadXml('ID_DE_FACTURA');

file_put_contents('factura.pdf', $pdfBytes);
```

**Enviar por Correo**
```php
$facturapi->invoices()->sendByEmail('ID_DE_FACTURA');
```

### 2. Clientes

**Crear un Cliente**
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

### 3. Productos

**Crear un Producto**
```php
$product = $facturapi->products()->create([
  'product_key' => '4319150114',
  'description' => 'Apple iPhone 8',
  'price' => 345.60,
]);
```

### 4. Organizaciones y Catálogos

**Definir Serie por Defecto para una Organización**
```php
$result = $facturapi->organizations()->updateDefaultSeries(
  'ID_DE_LA_ORGANIZACION',
  [
    'type' => 'I',
    'series' => 'A',
  ]
);
```

**Buscar en Catálogos**
```php
// Comercio Exterior
$results = $facturapi->comercioExteriorCatalogs()->searchTariffFractions([
  'q' => '0101',
  'page' => 0,
  'limit' => 10,
]);

// Nómina
$deductions = $facturapi->nominaCatalogs()->searchDeductions(["q" => "001"]);
$perceptions = $facturapi->nominaCatalogs()->searchPerceptions(["q" => "001"]);
```

### 5. Webhooks

**Validar Firma**
Para validar una firma de webhook entrante de manera local (sin llamar a la API), guarda tu secreto de webhook en tus variables de entorno (por ejemplo, `FACTURAPI_WEBHOOK_SECRET`) y pasa el cuerpo raw, el header de la firma y tu secreto al método `validateSignature`:

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
    // Manejar firma inválida
}
```

---

## Manejo de Errores ⚠️

En respuestas no-2xx, el SDK lanza `Facturapi\Exceptions\FacturapiException`.

La excepción incluye:
- `getMessage()`: Mensaje de error de la API (si está presente).
- `getStatusCode()`: Código de estado HTTP.
- `getErrorData()`: Payload del error decodificado (con toda la estructura de la API).
- `getRawBody()`: String crudo del body de la respuesta.

```php
use Facturapi\Exceptions\FacturapiException;

try {
  $facturapi->invoices()->create($payload);
} catch (FacturapiException $e) {
  $status = $e->getStatusCode();
  $error = $e->getErrorData(); // Shape completo del error de la API
  $firstDetail = $error['details'][0] ?? null; // ej. ['path' => 'items.0.quantity', 'message' => '...', 'code' => '...']
}
```

---

## Migrando de v4 a v5 🔄

La versión 5 introduce varios "breaking changes" diseñados para hacer el SDK más seguro y moderno:

1. **DTOs Estrictamente Tipados**: Todos los recursos de la API devuelven Data Transfer Objects (DTOs) e instancian Enums en lugar de arreglos genéricos.
    - **Sintaxis v4:** `$customer['legal_name']`
    - **Sintaxis v5:** `$customer->legal_name`
2. **Métodos de Recursos**: Los recursos de la API ahora se acceden mediante métodos en lugar de propiedades.
    - **Sintaxis v4:** `$facturapi->Customers`
    - **Sintaxis v5:** `$facturapi->customers()`
3. **Requiere PHP 8.2+**: Asegúrate de que tu servidor esté ejecutando PHP 8.2 o superior.
4. **Actualización del Cliente HTTP**: La implementación interna del cliente HTTP fue actualizada. El SDK se mantiene compatible con PSR-18 y descubrirá automáticamente los clientes instalados vía `php-http/discovery`.
5. **Características Eliminadas**: 
   - Se eliminó el soporte para el argumento posicional `apiVersion` en el constructor.
   - Se eliminaron los alias de métodos en snake_case.
   - `Facturapi\Exceptions\Facturapi_Exception` ha sido eliminado (Usa `Facturapi\Exceptions\FacturapiException`).

*(Nota: Los proyectos con Composer no requieren cambios en el autoloader. Los proyectos sin Composer deben descargar el `.zip` de la versión 5 y requerir el `autoload.php` empaquetado como de costumbre).*

Si aún no estás listo para actualizar, puedes fijar tu dependencia a la versión `^4.8`.

---

## Documentación 📚

Documentación completa: [https://docs.facturapi.io](https://docs.facturapi.io)

## Soporte 💬

- Problemas (Issues): abre un issue en GitHub
- Correo: `contacto@facturapi.io`
