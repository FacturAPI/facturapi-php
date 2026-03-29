<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class Retentions extends BaseClient
{
	protected string $ENDPOINT = 'retentions';


	/**
	 * Search Retentions
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
	 * Get a Retention by ID
	 *
	 * @param string $id Retention ID.
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
	 * Creates a Retention for the organization
	 *
	 * @param array $params Retention payload.
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
	 * Cancels a Retention
	 *
	 * @param string $id Retention ID.
	 * @param array $query URL query parameters.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function cancel($id, $query): mixed
	{
		try {
			return json_decode($this->executeDeleteRequest($this->getRequestUrl($id, $query), null));
		} catch (FacturapiException $e) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}

	/**
	 * Sends the retention to the customer's email
	 *
	 * @param string $id Retention ID.
	 * @param string|array|null $email Email or list of emails.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function sendByEmail($id, $email = null): mixed
	{
		try {
			return json_decode($this->executeJsonPostRequest(
				$this->getRequestUrl($id) . "/email",
				array("email" => $email)
			));
		} catch (FacturapiException $e) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}

	/**
	 * @deprecated Use sendByEmail() instead. Will be removed in v5.
	 */
	public function send_by_email($id, $email = null): mixed
	{
		trigger_error('Retentions::send_by_email() is deprecated and will be removed in v5. Use sendByEmail() instead.', E_USER_DEPRECATED);
		return $this->sendByEmail($id, $email);
	}

	/**
	 * Downloads the specified Retention in a ZIP package containing both PDF and XML files
	 *
	 * @param string $id Retention ID.
	 * @return string ZIP file contents.
	 *
	 * @throws FacturapiException
	 */
	public function downloadZip($id): string
	{
		try {
			return $this->executeGetRequest($this->getRequestUrl($id) . "/zip");
		} catch (FacturapiException $e) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}

	/**
	 * @deprecated Use downloadZip() instead. Will be removed in v5.
	 */
	public function download_zip($id): string
	{
		trigger_error('Retentions::download_zip() is deprecated and will be removed in v5. Use downloadZip() instead.', E_USER_DEPRECATED);
		return $this->downloadZip($id);
	}

	/**
	 * Downloads the specified Retention in a PDF file
	 *
	 * @param string $id Retention ID.
	 * @return string Raw PDF bytes (binary string, not base64-encoded).
	 *
	 * @throws FacturapiException
	 */
	public function downloadPdf($id): string
	{
		try {
			return $this->executeGetRequest($this->getRequestUrl($id) . "/pdf");
		} catch (FacturapiException $e) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}

	/**
	 * @deprecated Use downloadPdf() instead. Will be removed in v5.
	 */
	public function download_pdf($id): string
	{
		trigger_error('Retentions::download_pdf() is deprecated and will be removed in v5. Use downloadPdf() instead.', E_USER_DEPRECATED);
		return $this->downloadPdf($id);
	}

	/**
	 * Downloads the specified Retention in a XML file
	 *
	 * @param string $id Retention ID.
	 * @return string XML file contents.
	 *
	 * @throws FacturapiException
	 */
	public function downloadXml($id): string
	{
		try {
			return $this->executeGetRequest($this->getRequestUrl($id) . "/xml");
		} catch (FacturapiException $e) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}

	/**
	 * @deprecated Use downloadXml() instead. Will be removed in v5.
	 */
	public function download_xml($id): string
	{
		trigger_error('Retentions::download_xml() is deprecated and will be removed in v5. Use downloadXml() instead.', E_USER_DEPRECATED);
		return $this->downloadXml($id);
	}
}
