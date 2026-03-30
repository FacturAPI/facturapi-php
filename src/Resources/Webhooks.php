<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class Webhooks extends BaseClient
{
	protected string $ENDPOINT = 'webhooks';

	/**
	 * Get all Webhooks
	 *
	 * @param array|null $params Search parameters.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function all($params = null): mixed
	{
		try {
			return json_decode($this->executeGetRequest($this->getRequestUrl($params)));
		} catch (FacturapiException $e) {
			throw $e;
		}
	}

	/**
	 * Get a Webhook by ID
	 *
	 * @param string $id Webhook ID.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function retrieve($id): mixed
	{
		try {
			return json_decode($this->executeGetRequest($this->getRequestUrl($id)));
		} catch (FacturapiException $e) {
			throw $e;
		}
	}

	/**
	 * Create a Webhook in your organization
	 *
	 * @param array $params Webhook payload.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function create($params): mixed
	{
		try {
			return json_decode($this->executeJsonPostRequest($this->getRequestUrl(), $params));
		} catch (FacturapiException $e) {
			throw $e;
		}
	}


	/**
	 * Update a Webhook in your organization
	 *
	 * @param string $id Webhook ID.
	 * @param array $params Webhook payload.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function update($id, $params): mixed
	{
		try {
			return json_decode($this->executeJsonPutRequest($this->getRequestUrl($id), $params));
		} catch (FacturapiException $e) {
			throw $e;
		}
	}

	/**
	 * Delete a Webhook in your organization
	 *
	 * @param string $id Webhook ID.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function delete($id): mixed
	{
		try {
			return json_decode($this->executeDeleteRequest($this->getRequestUrl($id), null));
		} catch (FacturapiException $e) {
			throw $e;
		}
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
					return (object) array('valid' => $localResult);
				}
			} catch (\Throwable $ignored) {
				// Fallback to server-side verification.
			}
		}

		try {
			return json_decode($this->executeJsonPostRequest($this->getRequestUrl() . '/validate-signature', $data));
		} catch (FacturapiException $e) {
			throw $e;
		}
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
