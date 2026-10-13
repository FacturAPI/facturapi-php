# Integration with CodeIgniter 4

This document shows how to integrate the Facturapi SDK into a CodeIgniter 4 project.

## 1. Environment Variables Configuration

Add your Facturapi API key to your `.env` file:

```env
FACTURAPI_KEY=sk_test_your_api_key
FACTURAPI_WEBHOOK_SECRET=your_webhook_secret
```

## 2. Services Configuration

To have a single shared instance of the SDK throughout your application, configure it in `app/Config/Services.php`:

```php
namespace Config;

use CodeIgniter\Config\BaseService;
use Facturapi\Facturapi;

class Services extends BaseService
{
    // ...

    public static function facturapi($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('facturapi');
        }

        $apiKey = env('FACTURAPI_KEY');
        return new Facturapi($apiKey);
    }
}
```

## 3. Usage in a Controller

You can access the service instance we just created in any controller using the `Config\Services` class:

```php
namespace App\Controllers;

use Config\Services;

class InvoiceController extends BaseController
{
    public function index()
    {
        $facturapi = Services::facturapi();

        // Usage example: List customers
        $customers = $facturapi->customers()->all();

        return $this->response->setJSON($customers);
    }
}
```

## 4. Webhook Validation

You can validate incoming webhooks locally using the `validateSignature` method:

```php
namespace App\Controllers;

use Config\Services;

class WebhookController extends BaseController
{
    public function handle()
    {
        $facturapi = Services::facturapi();

        $isValid = $facturapi->webhooks()->validateSignature([
            'body' => $this->request->getBody(),
            'signature' => $this->request->getHeaderLine('x-signature'),
            'webhookSecret' => env('FACTURAPI_WEBHOOK_SECRET'),
        ]);

        if (!$isValid['valid']) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Invalid signature']);
        }

        // Process your webhook...

        return $this->response->setJSON(['status' => 'ok']);
    }
}
```

## 5. Long-Running Processes (FrankenPHP, RoadRunner, Swoole)

If you run CodeIgniter via a long-lived process (like FrankenPHP or Swoole), returning `static::getSharedInstance('facturapi')` is perfectly safe if you use a single, global API key.

However, if your application is **multi-tenant** and requires a different API key per request, you should instantiate the SDK on-demand rather than as a shared service, ensuring the correct key is loaded for the current request:

```php
// Retrieve a fresh, non-shared instance for the current tenant
$facturapi = Services::facturapi(false); 
```
(Be sure to modify your Service to accept or look up the tenant's API key when `$getShared` is `false`).
