<?php

declare(strict_types=1);

namespace Facturapi\Resources;

use Facturapi\Exceptions\FacturapiException;
use Facturapi\Http\FacturapiHttpClient;
use Facturapi\Models\DomainAvailability;
use Facturapi\Models\Organization;
use Facturapi\Models\OrganizationSearchResult;

class Organizations
{
    public function __construct(private readonly FacturapiHttpClient $client)
    {
    }


    /**
     * Get all Organizations
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function all(?array $params = null): OrganizationSearchResult
    {
        return OrganizationSearchResult::fromArray($this->client->get('organizations', $params));
    }

    /**
     * Get an Organization by ID.
     *
     * @param string $id Organization ID.
     * @return Organization JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function retrieve(string $id): Organization
    {
        return Organization::fromArray($this->client->get('organizations/' . $id));
    }

    /**
     * Create an Organization.
     *
     * @param array $params Organization payload.
     * @return Organization JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function create(array $params): Organization
    {
        return Organization::fromArray($this->client->post('organizations', $params));
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
    public function updateLegal(string $id, array $params): Organization
    {
        return Organization::fromArray($this->client->put('organizations/' . $id . '/legal', $params));
    }

    /**
     * Update an organization's customization information.
     *
     * @param string $id Organization ID.
     * @param array $params Customization payload.
     * @return Organization JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function updateCustomization(string $id, array $params): Organization
    {
        return Organization::fromArray($this->client->put('organizations/' . $id . '/customization', $params));
    }

    /**
     * Update an organization's receipt settings.
     *
     * @param string $id Organization ID.
     * @param array $params Receipt settings payload.
     * @return Organization JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function updateReceiptSettings(string $id, array $params): Organization
    {
        return Organization::fromArray($this->client->put('organizations/' . $id . '/receipts', $params));
    }

    /**
     * Update an organization's domain.
     *
     * @param string $id Organization ID.
     * @param array $params Domain payload.
     * @return Organization JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function updateDomain(string $id, array $params): Organization
    {
        return Organization::fromArray($this->client->put('organizations/' . $id . '/domain', $params));
    }

    /**
     * Check domain availability.
     *
     * @param array $query Domain check query parameters.
     * @return mixed JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function checkDomainAvailability($query): DomainAvailability
    {
        if (!is_array($query)) {
            throw new FacturapiException('checkDomainAvailability expects $query to be an array.');
        }

        return DomainAvailability::fromArray($this->client->get('organizations/' . 'domain-check', $query));
    }

    /**
     * @deprecated Use checkDomainAvailability($query) instead. This alias will be removed in v5.
     *
     * @param array|string $idOrQuery Domain check query parameters, or legacy organization ID.
     * @param array|null $query Legacy query parameters when using historical signature.
     * @return DomainAvailability JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function checkDomainIsAvailable($idOrQuery, ?array $query = null): DomainAvailability
    {
        trigger_error(
            'Organizations::checkDomainIsAvailable(...) is deprecated and will be removed in v5. Use checkDomainAvailability($query) instead.',
            E_USER_DEPRECATED
        );

        $argsCount = func_num_args();
        if ($argsCount === 1 && is_array($idOrQuery)) {
            return $this->checkDomainAvailability($idOrQuery);
        }

        if ($argsCount >= 2 && is_array($query)) {
            // Backward compatibility with historical signature: ($id, $params).
            return $this->checkDomainAvailability($query);
        }

        throw new FacturapiException('checkDomainIsAvailable expects either ($query) or ($id, $params).');
    }

    /**
     * Uploads the organization's logo
     *
     * @param string $id Organization ID.
     * @param string $params Logo file path.
     * @return Organization JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function uploadLogo(string $id, string $file): Organization
    {
        return Organization::fromArray($this->client->multipartRequest('PUT', 'organizations/' . $id . '/logo', ['file' => $file]));
    }

    /**
     * Uploads the organization's certificate (CSD)
     *
     * @param string $id Organization ID.
     * @param array $params Certificate payload (`cerFile`, `keyFile`, `password`).
     * @return Organization JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function uploadCertificate(string $id, array $params): Organization
    {
        $files = [];
        $data = [];
        if (!isset($params['cerFile']) || !isset($params['keyFile']) || !isset($params['password'])) {
            throw new \Facturapi\Exceptions\FacturapiException('Invalid certificate payload. Expected cerFile, keyFile and password.');
        }
        if (isset($params['cerFile'])) {
            $files['cer'] = $params['cerFile'];
        }
        if (isset($params['keyFile'])) {
            $files['key'] = $params['keyFile'];
        }
        if (isset($params['password'])) {
            $data['password'] = $params['password'];
        }

        return Organization::fromArray($this->client->multipartRequest('PUT', 'organizations/' . $id . '/certificate', $files, $data));
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
        return $this->client->get('organizations/' . $id . '/apikeys/test');
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
        return $this->client->put('organizations/' . $id . '/apikeys/test', []);
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
        return $this->client->get('organizations/' . $id . '/apikeys/live');
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
        return $this->client->put('organizations/' . $id . '/apikeys/live', []);
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
        return $this->client->delete('organizations/' . $organizationId . '/apikeys/live/' . $apiKeyId);
    }

    /**
     * Delete an organization.
     *
     * @param string $id Organization ID.
     * @return Organization JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function delete(string $id): Organization
    {
        return Organization::fromArray($this->client->delete('organizations/' . $id));
    }

    /**
     * Delete an organization's certificate.
     *
     * @param string $id Organization ID.
     * @return Organization JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function deleteCertificate(string $id): Organization
    {
        return Organization::fromArray($this->client->delete('organizations/' . $id . '/certificate'));
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
        return $this->client->get('organizations/' . $id . '/series-group');
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
    public function createSeriesGroup($id, array $params): mixed
    {
        return $this->client->post('organizations/' . $id . '/series-group', $params);
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
    public function updateSeriesGroup(string $id, string $series_name, array $params): mixed
    {
        return $this->client->put('organizations/' . $id . '/series-group/' . $series_name, $params);
    }

    /**
     * Update default series for an organization.
     *
     * @param string $id Organization ID.
     * @param array $params Default series payload.
     * @return mixed JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function updateDefaultSeries($id, array $params): mixed
    {
        return $this->client->put('organizations/' . $id . '/series-group/default-series', $params);
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
    public function deleteSeriesGroup(string $id, string $series_name): mixed
    {
        return $this->client->delete('organizations/' . $id . '/series-group/' . $series_name);
    }

    /**
     * Update self-invoice settings for an Organization
     *
     * @param string $id Organization ID.
     * @param array $params Self-invoice settings payload.
     * @return Organization JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function updateSelfInvoiceSettings(string $id, array $params): Organization
    {
        return Organization::fromArray($this->client->put('organizations/' . $id . '/self-invoice', $params));
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
        return $this->client->get('organizations/' . $organizationId . '/team');
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
        return $this->client->get('organizations/' . $organizationId . '/team/' . $accessId);
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
        return $this->client->put('organizations/' . $organizationId . '/team/' . $accessId . '/role', ['role' => $role]);
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
        return $this->client->delete('organizations/' . $organizationId . '/team/' . $accessId);
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
        return $this->client->get('organizations/' . $organizationId . '/team/invites');
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
    public function inviteUserToTeam($organizationId, array $params): mixed
    {
        return $this->client->post('organizations/' . $organizationId . '/team/invites', $params);
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
        return $this->client->delete('organizations/' . $organizationId . '/team/invites/' . $inviteKey);
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
        return $this->client->get('organizations/' . 'invites/pending');
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
    public function respondTeamInvite($inviteKey, array $params): mixed
    {
        return $this->client->post('organizations/' . 'invites/' . $inviteKey . '/response', $params);
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
        return $this->client->get('organizations/' . $organizationId . '/team/roles');
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
        return $this->client->get('organizations/' . $organizationId . '/team/roles/templates');
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
        return $this->client->get('organizations/' . $organizationId . '/team/roles/operations');
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
        return $this->client->get('organizations/' . $organizationId . '/team/roles/' . $roleId);
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
    public function createTeamRole($organizationId, array $params): mixed
    {
        return $this->client->post('organizations/' . $organizationId . '/team/roles', $params);
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
    public function updateTeamRole($organizationId, $roleId, array $params): mixed
    {
        return $this->client->put('organizations/' . $organizationId . '/team/roles/' . $roleId, $params);
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
        return $this->client->delete('organizations/' . $organizationId . '/team/roles/' . $roleId);
    }
}
