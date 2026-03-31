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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
    }
  }

  /**
   * Check domain availability.
   *
   * @param array $query Domain check query parameters.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function checkDomainIsAvailable($query): mixed
  {
    if (!is_array($query)) {
      throw new FacturapiException('checkDomainIsAvailable expects $query to be an array.');
    }

    try {
      return json_decode(
        $this->executeGetRequest(
          $this->getRequestUrl("domain-check", $query)
        )
      );
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * Alias for consistency with API operation naming.
   */
  public function checkDomainAvailability($query): mixed
  {
    return $this->checkDomainIsAvailable($query);
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
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
      throw $e;
    }
  }

  /**
   * List users with access to an organization.
   *
   * @param string $organizationId Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function listTeamAccess($organizationId): mixed
  {
    try {
      return json_decode($this->executeGetRequest($this->getRequestUrl($organizationId) . "/team"));
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * Retrieve one user access entry within an organization.
   *
   * @param string $organizationId Organization ID.
   * @param string $accessId Access ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function retrieveTeamAccess($organizationId, $accessId): mixed
  {
    try {
      return json_decode($this->executeGetRequest($this->getRequestUrl($organizationId) . "/team/" . $accessId));
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * Reassign a role to a user access entry.
   *
   * @param string $organizationId Organization ID.
   * @param string $accessId Access ID.
   * @param string $role Role ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function updateTeamAccessRole($organizationId, $accessId, $role): mixed
  {
    try {
      return json_decode(
        $this->executeJsonPutRequest(
          $this->getRequestUrl($organizationId) . "/team/" . $accessId . "/role",
          ["role" => $role]
        )
      );
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * Remove a user access entry from an organization.
   *
   * @param string $organizationId Organization ID.
   * @param string $accessId Access ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function removeTeamAccess($organizationId, $accessId): mixed
  {
    try {
      return json_decode(
        $this->executeDeleteRequest(
          $this->getRequestUrl($organizationId) . "/team/" . $accessId,
          null
        )
      );
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * List sent team invites for an organization.
   *
   * @param string $organizationId Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function listSentTeamInvites($organizationId): mixed
  {
    try {
      return json_decode($this->executeGetRequest($this->getRequestUrl($organizationId) . "/team/invites"));
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * Create or update a team invite for an organization.
   *
   * @param string $organizationId Organization ID.
   * @param array $params Invite payload.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function inviteUserToTeam($organizationId, $params): mixed
  {
    try {
      return json_decode(
        $this->executeJsonPostRequest(
          $this->getRequestUrl($organizationId) . "/team/invites",
          $params
        )
      );
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * Cancel a pending team invite.
   *
   * @param string $organizationId Organization ID.
   * @param string $inviteKey Invite key.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function cancelTeamInvite($organizationId, $inviteKey): mixed
  {
    try {
      return json_decode(
        $this->executeDeleteRequest(
          $this->getRequestUrl($organizationId) . "/team/invites/" . $inviteKey,
          null
        )
      );
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * List pending invites received by the authenticated user.
   *
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function listReceivedTeamInvites(): mixed
  {
    try {
      return json_decode($this->executeGetRequest($this->getRequestUrl("invites/pending")));
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * Respond to a team invite.
   *
   * @param string $inviteKey Invite key.
   * @param array $params Response payload.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function respondTeamInvite($inviteKey, $params): mixed
  {
    try {
      return json_decode(
        $this->executeJsonPostRequest(
          $this->getRequestUrl("invites/" . $inviteKey . "/response"),
          $params
        )
      );
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * List organization team roles.
   *
   * @param string $organizationId Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function listTeamRoles($organizationId): mixed
  {
    try {
      return json_decode($this->executeGetRequest($this->getRequestUrl($organizationId) . "/team/roles"));
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * List team role templates.
   *
   * @param string $organizationId Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function listTeamRoleTemplates($organizationId): mixed
  {
    try {
      return json_decode($this->executeGetRequest($this->getRequestUrl($organizationId) . "/team/roles/templates"));
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * List team role operations.
   *
   * @param string $organizationId Organization ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function listTeamRoleOperations($organizationId): mixed
  {
    try {
      return json_decode($this->executeGetRequest($this->getRequestUrl($organizationId) . "/team/roles/operations"));
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * Retrieve a team role by ID.
   *
   * @param string $organizationId Organization ID.
   * @param string $roleId Role ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function retrieveTeamRole($organizationId, $roleId): mixed
  {
    try {
      return json_decode($this->executeGetRequest($this->getRequestUrl($organizationId) . "/team/roles/" . $roleId));
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * Create a team role.
   *
   * @param string $organizationId Organization ID.
   * @param array $params Role payload.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function createTeamRole($organizationId, $params): mixed
  {
    try {
      return json_decode(
        $this->executeJsonPostRequest(
          $this->getRequestUrl($organizationId) . "/team/roles",
          $params
        )
      );
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * Update a team role.
   *
   * @param string $organizationId Organization ID.
   * @param string $roleId Role ID.
   * @param array $params Role payload.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function updateTeamRole($organizationId, $roleId, $params): mixed
  {
    try {
      return json_decode(
        $this->executeJsonPutRequest(
          $this->getRequestUrl($organizationId) . "/team/roles/" . $roleId,
          $params
        )
      );
    } catch (FacturapiException $e) {
      throw $e;
    }
  }

  /**
   * Delete a team role.
   *
   * @param string $organizationId Organization ID.
   * @param string $roleId Role ID.
   * @return mixed JSON-decoded response.
   *
   * @throws FacturapiException
   */
  public function deleteTeamRole($organizationId, $roleId): mixed
  {
    try {
      return json_decode(
        $this->executeDeleteRequest(
          $this->getRequestUrl($organizationId) . "/team/roles/" . $roleId,
          null
        )
      );
    } catch (FacturapiException $e) {
      throw $e;
    }
  }
}
