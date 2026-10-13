<?php

declare(strict_types=1);

namespace Facturapi\Resources;

use Facturapi\Exceptions\FacturapiException;
use Facturapi\Http\FacturapiHttpClient;
use Facturapi\Models\Retention;
use Facturapi\Models\RetentionSearchResult;
use Facturapi\Models\SuccessResponse;

class Retentions
{
    public function __construct(private readonly FacturapiHttpClient $client)
    {
    }


    /**
     * Search Retentions
     *
     * @param array|null $params Search parameters.
     * @return RetentionSearchResult JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function all(?array $params = null): RetentionSearchResult
    {
        return RetentionSearchResult::fromArray($this->client->get('retentions', $params));
    }

    /**
     * Get a Retention by ID
     *
     * @param string $id Retention ID.
     * @return Retention JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function retrieve(string $id): Retention
    {
        return Retention::fromArray($this->client->get('retentions/' . $id));
    }

    /**
     * Creates a Retention for the organization
     *
     * @param array $params Retention payload.
     * @return Retention JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function create(array $params): Retention
    {
        return Retention::fromArray($this->client->post('retentions', $params));
    }


    /**
     * Cancels a Retention
     *
     * @param string $id Retention ID.
     * @param array|null $query URL query parameters.
     * @return Retention JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function cancel(string $id, ?array $query = null): Retention
    {
        return Retention::fromArray($this->client->delete('retentions/' . $id, $query));
    }

    /**
     * Updates a Retention with "draft" status
     *
     * @param string $id Retention ID.
     * @param array $body Draft payload.
     * @return Retention JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function updateDraft(string $id, array $body): Retention
    {
        return Retention::fromArray($this->client->put('retentions/' . $id, $body));
    }

    /**
     * @deprecated Use updateDraft() instead. Will be removed in v5.
     */
    public function update_draft(string $id, array $body): Retention
    {
        trigger_error('Retentions::update_draft() is deprecated and will be removed in v5. Use updateDraft() instead.', E_USER_DEPRECATED);
        return $this->updateDraft($id, $body);
    }

    /**
     * Creates a new draft Retention copying the information from the specified Retention
     *
     * @param string $id Retention ID.
     * @return Retention JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function copyToDraft(string $id): Retention
    {
        return Retention::fromArray($this->client->post('retentions/' . $id . '/copy', []));
    }

    /**
     * @deprecated Use copyToDraft() instead. Will be removed in v5.
     */
    public function copy_to_draft(string $id): Retention
    {
        trigger_error('Retentions::copy_to_draft() is deprecated and will be removed in v5. Use copyToDraft() instead.', E_USER_DEPRECATED);
        return $this->copyToDraft($id);
    }

    /**
     * Stamps a draft Retention
     *
     * @param string $id Retention ID.
     * @return Retention JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function stampDraft(string $id): Retention
    {
        return Retention::fromArray($this->client->post('retentions/' . $id . '/stamp', []));
    }

    /**
     * @deprecated Use stampDraft() instead. Will be removed in v5.
     */
    public function stamp_draft(string $id): Retention
    {
        trigger_error('Retentions::stamp_draft() is deprecated and will be removed in v5. Use stampDraft() instead.', E_USER_DEPRECATED);
        return $this->stampDraft($id);
    }

    /**
     * Sends the retention to the customer's email
     *
     * @param string $id Retention ID.
     * @param string|array|null $email Email or list of emails.
     * @return SuccessResponse JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function sendByEmail(string $id, string|array|null $email = null): SuccessResponse
    {
        $payload = [];
        if ($email !== null) {
            $payload['email'] = is_array($email) ? $email : [$email];
        }

        return SuccessResponse::fromArray($this->client->post('retentions/' . $id . '/email', $payload));
    }

    /**
     * @deprecated Use sendByEmail() instead. Will be removed in v5.
     */
    public function send_by_email(string $id, string|array|null $email = null): SuccessResponse
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
    public function downloadZip(string $id): string
    {
        return $this->client->download('retentions/' . $id . '/zip');
    }

    /**
     * @deprecated Use downloadZip() instead. Will be removed in v5.
     */
    public function download_zip(string $id): string
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
    public function downloadPdf(string $id): string
    {
        return $this->client->download('retentions/' . $id . '/pdf');
    }

    /**
     * @deprecated Use downloadPdf() instead. Will be removed in v5.
     */
    public function download_pdf(string $id): string
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
    public function downloadXml(string $id): string
    {
        return $this->client->download('retentions/' . $id . '/xml');
    }

    /**
     * @deprecated Use downloadXml() instead. Will be removed in v5.
     */
    public function download_xml(string $id): string
    {
        trigger_error('Retentions::download_xml() is deprecated and will be removed in v5. Use downloadXml() instead.', E_USER_DEPRECATED);
        return $this->downloadXml($id);
    }
}
