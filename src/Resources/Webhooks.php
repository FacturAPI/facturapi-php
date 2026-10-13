<?php

declare(strict_types=1);

namespace Facturapi\Resources;

use Facturapi\Exceptions\FacturapiException;
use Facturapi\Http\FacturapiHttpClient;
use Facturapi\Models\Webhook;
use Facturapi\Models\WebhookSearchResult;

class Webhooks
{
    public function __construct(private readonly FacturapiHttpClient $client)
    {
    }

    /**
     * Get all Webhooks
     *
     * @param array|null $params Search parameters.
     * @return WebhookSearchResult JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function all(?array $params = null): WebhookSearchResult
    {
        return WebhookSearchResult::fromArray($this->client->get('webhooks', $params));
    }

    /**
     * Get a Webhook by ID
     *
     * @param string $id Webhook ID.
     * @return Webhook JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function retrieve(string $id): Webhook
    {
        return Webhook::fromArray($this->client->get('webhooks/' . $id));
    }

    /**
     * Create a Webhook in your organization
     *
     * @param array $params Webhook payload.
     * @return Webhook JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function create(array $params): Webhook
    {
        return Webhook::fromArray($this->client->post('webhooks', $params));
    }


    /**
     * Update a Webhook in your organization
     *
     * @param string $id Webhook ID.
     * @param array $params Webhook payload.
     * @return Webhook JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function update(string $id, array $params): Webhook
    {
        return Webhook::fromArray($this->client->put('webhooks/' . $id, $params));
    }

    /**
     * Delete a Webhook in your organization
     *
     * @param string $id Webhook ID.
     * @return Webhook JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function delete(string $id): Webhook
    {
        return Webhook::fromArray($this->client->delete('webhooks/' . $id));
    }

    /**
     * Validates a webhook signature payload.
     *
     * Local verification is attempted first when `body`, `signature`, and
     * `webhookSecret` are provided in `$data`. If local verification cannot be
     * performed for any reason, the SDK falls back to the API endpoint.
     *
     * @param array $data Signature payload.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function validateSignature($data): mixed
    {
        if (is_array($data)) {
            try {
                $localResult = $this->verifySignatureLocallyFromPayload($data);
                if ($localResult !== null) {
                    return ['valid' => $localResult];
                }
            } catch (\Throwable) {
                // Fallback to server-side verification.
            }
        }

        return $this->client->post('webhooks/validate-signature', $data);
    }

    /**
     * Attempts local signature verification when payload has required fields.
     * Returns null when local verification cannot be attempted.
     */
    private function verifySignatureLocallyFromPayload(array $data): ?bool
    {
        $rawBody = $data['body'] ?? $data['payload'] ?? $data['rawBody'] ?? null;
        $signature = $data['signature'] ?? $data['x-signature'] ?? $data['x_signature'] ?? null;
        $webhookSecret = $data['webhookSecret'] ?? $data['webhook_secret'] ?? $data['secret'] ?? null;

        if (!is_string($rawBody) || !is_string($signature) || !is_string($webhookSecret)) {
            return null;
        }

        return $this->verifySignatureLocally($rawBody, $signature, $webhookSecret);
    }

    /**
     * Local HMAC-SHA256 signature verification.
     */
    private function verifySignatureLocally(string $rawBody, string $signature, string $webhookSecret): bool
    {
        $normalizedSignature = trim($signature);
        if (str_starts_with($normalizedSignature, 'sha256=')) {
            $normalizedSignature = substr($normalizedSignature, 7);
        }

        $expectedHex = hash_hmac('sha256', $rawBody, $webhookSecret);

        return hash_equals($expectedHex, $normalizedSignature);
    }
}
