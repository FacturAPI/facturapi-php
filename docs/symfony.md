# Integration with Symfony

This document shows how to integrate the Facturapi SDK into a Symfony project.

## 1. Environment Variables Configuration

Add your Facturapi API key to your `.env` or `.env.local` file:

```env
FACTURAPI_KEY=sk_test_your_api_key
FACTURAPI_WEBHOOK_SECRET=your_webhook_secret
```

## 2. Services Configuration

Configure dependency injection in `config/services.yaml` so Symfony knows how to instantiate the `Facturapi` class:

```yaml
# config/services.yaml
services:
    # ...

    Facturapi\Facturapi:
        arguments:
            $apiKey: '%env(FACTURAPI_KEY)%'
```

## 3. Usage in a Controller

With the configuration above, Symfony will automatically inject the configured instance into your controllers:

```php
namespace App\Controller;

use Facturapi\Facturapi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    #[Route('/customers', name: 'app_customers')]
    public function index(Facturapi $facturapi): JsonResponse
    {
        // Usage example: List customers
        $customers = $facturapi->customers()->all();

        return $this->json($customers);
    }
}
```

## 4. Webhook Validation

You can validate incoming webhooks locally using the `validateSignature` method:

```php
namespace App\Controller;

use Facturapi\Facturapi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class WebhookController extends AbstractController
{
    #[Route('/webhook', name: 'app_webhook', methods: ['POST'])]
    public function handle(
        Request $request,
        Facturapi $facturapi,
        #[Autowire(env: 'FACTURAPI_WEBHOOK_SECRET')] string $webhookSecret
    ): JsonResponse {
        $isValid = $facturapi->webhooks()->validateSignature([
            'body' => $request->getContent(),
            'signature' => $request->headers->get('x-signature'),
            'webhookSecret' => $webhookSecret,
        ]);

        if (!$isValid['valid']) {
            return $this->json(['error' => 'Invalid signature'], 401);
        }

        // Process your webhook...

        return $this->json(['status' => 'ok']);
    }
}
```

## 5. Long-Running Processes (FrankenPHP, RoadRunner, Swoole)

If you are serving your Symfony application using FrankenPHP, RoadRunner, or Swoole, the SDK is safe to be registered as a standard service (which is a singleton by default in Symfony) as it contains no request-specific state. 

However, if you are building a **multi-tenant** application where the API key changes per request, you should avoid injecting the SDK as a singleton. Instead, instantiate `Facturapi` dynamically inside your controllers or inject it via a factory that reads the tenant's API key from the request context.
