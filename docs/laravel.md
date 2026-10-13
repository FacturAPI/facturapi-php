# Integration with Laravel

This document shows how to integrate the Facturapi SDK into a Laravel project.

## 1. Environment Variables Configuration

Add your Facturapi API key to your `.env` file:

```env
FACTURAPI_KEY=sk_test_your_api_key
FACTURAPI_WEBHOOK_SECRET=your_webhook_secret
```

## 2. Services Configuration

Add the Facturapi configuration in the `config/services.php` file:

```php
// config/services.php
return [
    // ...
    'facturapi' => [
        'key' => env('FACTURAPI_KEY'),
        'webhook_secret' => env('FACTURAPI_WEBHOOK_SECRET'),
    ],
];
```

## 3. Service Container Registration

Register the `Facturapi\Facturapi` class as a Singleton in `app/Providers/AppServiceProvider.php`:

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Facturapi\Facturapi;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Facturapi::class, function ($app) {
            return new Facturapi(config('services.facturapi.key'));
        });
    }

    public function boot(): void
    {
        //
    }
}
```

## 4. Usage in a Controller

You can now inject the Facturapi instance directly into your controllers:

```php
namespace App\Http\Controllers;

use Facturapi\Facturapi;
use Illuminate\Http\JsonResponse;

class InvoiceController extends Controller
{
    public function index(Facturapi $facturapi): JsonResponse
    {
        // Usage example: List customers
        $customers = $facturapi->customers()->all();

        return response()->json($customers);
    }
}
```

## 5. Webhook Validation

You can easily validate incoming webhooks locally (without an API call) by passing the raw request body, the signature header, and your secret to the `validateSignature` method:

```php
namespace App\Http\Controllers;

use Facturapi\Facturapi;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WebhookController extends Controller
{
    public function handle(Request $request, Facturapi $facturapi): JsonResponse
    {
        $isValid = $facturapi->webhooks()->validateSignature([
            'body' => $request->getContent(),
            'signature' => $request->header('x-signature'),
            'webhookSecret' => config('services.facturapi.webhook_secret'),
        ]);

        if (!$isValid['valid']) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        // Process your webhook...

        return response()->json(['status' => 'ok']);
    }
}
```

## 6. Laravel Octane (FrankenPHP, RoadRunner, Swoole)

If you use a long-running application server like FrankenPHP, RoadRunner, or Swoole (via Laravel Octane), the SDK is perfectly safe to be registered as a `singleton` as long as you use a single API key for your entire application. The underlying HTTP client can be safely shared across requests.

However, if your application is **multi-tenant** (e.g. you use a different Facturapi key depending on the authenticated user or tenant), you must register the SDK as a `scoped` instance rather than a `singleton`. This ensures a fresh instance is created per request:

```php
// In AppServiceProvider
$this->app->scoped(Facturapi::class, function ($app) {
    // Example: fetching the key dynamically based on the current tenant
    $tenantKey = $app->make(CurrentTenant::class)->facturapi_key;
    return new Facturapi($tenantKey);
});
```
