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
			throw new FacturapiException($e->getMessage(), 0, $e);
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
			throw new FacturapiException($e->getMessage(), 0, $e);
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
			throw new FacturapiException($e->getMessage(), 0, $e);
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
			throw new FacturapiException($e->getMessage(), 0, $e);
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
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}

	/**
	 * Validates a webhook signature payload.
	 *
	 * @param array $data Signature payload.
	 * @return mixed JSON-decoded response.
	 * @throws FacturapiException
	 */
	public function validateSignature($data): mixed
	{
		try {
			return json_decode($this->executeJsonPostRequest($this->getRequestUrl() . '/validate-signature', $data));
		} catch (FacturapiException $e) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}
}
