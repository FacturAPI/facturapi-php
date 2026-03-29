<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class Organizations extends BaseClient
{
  protected string $ENDPOINT = 'organizations';


  /**
   * Get all Organizations
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
   * Get an Organization by ID.
   *
   * @param string $id Organization ID.
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
   * Create an Organization.
   *
   * @param array $params Organization payload.
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
   * Update an organization's legal information.
   *
   * @param string $id Organization ID.
   * @param array $params Legal information payload.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function updateLegal($id, $params): mixed
  {
    try {
      return json_decode($this->executeJsonPutRequest($this->getRequestUrl($id) . "/legal", $params));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Update an organization's customization information.
   *
   * @param string $id Organization ID.
   * @param array $params Customization payload.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function updateCustomization($id, $params): mixed
  {
    try {
      return json_decode($this->executeJsonPutRequest($this->getRequestUrl($id) . "/customization", $params));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Update an organization's receipt settings.
   *
   * @param string $id Organization ID.
   * @param array $params Receipt settings payload.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function updateReceiptSettings($id, $params): mixed
  {
    try {
      return json_decode($this->executeJsonPutRequest($this->getRequestUrl($id) . "/receipts", $params));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Update an organization's domain.
   *
   * @param string $id Organization ID.
   * @param array $params Domain payload.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function updateDomain($id, $params): mixed
  {
    try {
      return json_decode($this->executeJsonPutRequest($this->getRequestUrl($id) . "/domain", $params));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Check domain availability.
   *
   * @param string $id Organization ID.
   * @param array $params Domain check parameters.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function checkDomainIsAvailable($id, $params): mixed
  {
    try {
      return json_decode(
        $this->executeGetRequest(
          $this->getRequestUrl("domain-check", $params)
        )
      );
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Uploads the organization's logo
   *
   * @param string $id Organization ID.
   * @param string $params Logo file path.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function uploadLogo($id, $params): mixed
  {
    try {
      return json_decode($this->executeDataPutRequest($this->getRequestUrl($id) . "/logo", $params));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Uploads the organization's certificate (CSD)
   *
   * @param string $id Organization ID.
   * @param array $params Certificate payload (`cerFile`, `keyFile`, `password`).
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function uploadCertificate($id, $params): mixed
  {
    try {
      return json_decode($this->executeDataPutRequest($this->getRequestUrl($id) . "/certificate", $params));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Get the test API key for an organization.
   *
   * @param string $id Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function getTestApiKey($id): mixed
  {
    try {
      return json_decode($this->executeGetRequest($this->getRequestUrl($id) . "/apikeys/test"));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Renew the test API key for an organization.
   *
   * @param string $id Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function renewTestApiKey($id): mixed
  {
    try {
      return json_decode(
        $this->executeJsonPutRequest(
          $this->getRequestUrl($id) . "/apikeys/test",
          []
        )
      );
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * @deprecated Use listLiveApiKeys() instead. Will be removed in v5.
   *
   * @param string $id Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function lisLiveApiKeys($id): mixed
  {
    trigger_error('Organizations::lisLiveApiKeys() is deprecated and will be removed in v5. Use listLiveApiKeys() instead.', E_USER_DEPRECATED);
    return $this->listLiveApiKeys($id);
  }

  /**
   * List live API keys for an organization.
   *
   * @param string $id Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function listLiveApiKeys($id): mixed
  {
    try {
      return json_decode(
        $this->executeGetRequest(
          $this->getRequestUrl($id) . "/apikeys/live"
        )
      );
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Renew the live API key for an organization.
   *
   * @param string $id Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function renewLiveApiKey($id): mixed
  {
    try {
      return json_decode(
        $this->executeJsonPutRequest(
          $this->getRequestUrl($id) . "/apikeys/live",
          []
        )
      );
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Delete one live API key for an organization.
   *
   * @param string $organizationId Organization ID.
   * @param string $apiKeyId API key ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function deleteLiveApiKey($organizationId, $apiKeyId): mixed
  {
    try {
      return json_decode(
        $this->executeJsonPutRequest(
          $this->getRequestUrl($organizationId) . "/apikeys/live" . "/" . $apiKeyId,
          []
        )
      );
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Delete an organization.
   *
   * @param string $id Organization ID.
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
   * Delete an organization's certificate.
   *
   * @param string $id Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function deleteCertificate($id): mixed
  {
    try {
      return json_decode($this->executeDeleteRequest($this->getRequestUrl($id) .  "/certificate", null));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Get series groups for an organization.
   *
   * @param string $id Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function getSeriesGroup($id): mixed
  {
    try {
      return json_decode($this->executeGetRequest($this->getRequestUrl($id) . "/series-group"));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Create a series group for an organization.
   *
   * @param string $id Organization ID.
   * @param array $params Series group payload.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function createSeriesGroup($id, $params): mixed
  {
    try {
      return json_decode($this->executeJsonPostRequest($this->getRequestUrl($id) . "/series-group", $params));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Update a series group for an organization.
   *
   * @param string $id Organization ID.
   * @param string $series_name Series name.
   * @param array $params Series group payload.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function updateSeriesGroup($id, $series_name, $params): mixed
  {
    try {
      return json_decode($this->executeJsonPutRequest($this->getRequestUrl($id) . "/series-group" . "/" . $series_name, $params));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Delete a series group for an organization.
   *
   * @param string $id Organization ID.
   * @param string $series_name Series name.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function deleteSeriesGroup($id, $series_name): mixed
  {
    try {
      return json_decode($this->executeDeleteRequest($this->getRequestUrl($id) . "/series-group" . "/" . $series_name, null));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }

  /**
   * Update self-invoice settings for an Organization
   *
   * @param string $id Organization ID.
   * @param array $params Self-invoice settings payload.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function updateSelfInvoiceSettings($id, $params): mixed
  {
    try {
      return json_decode($this->executeJsonPutRequest($this->getRequestUrl($id) . "/self-invoice", $params));
    } catch (FacturapiException $e) {
      throw new FacturapiException($e->getMessage(), 0, $e);
    }
  }
}
