<?php

declare(strict_types=1);

namespace Facturapi\Resources;

use Facturapi\Exceptions\FacturapiException;
use Facturapi\Http\FacturapiHttpClient;
use Facturapi\Models\Invoice;
use Facturapi\Models\Receipt;
use Facturapi\Models\ReceiptSearchResult;
use Facturapi\Models\SignedDownloadUrl;
use Facturapi\Models\SuccessResponse;

class Receipts
{
    public function __construct(private readonly FacturapiHttpClient $client)
    {
    }


    /**
     * Search or list all receipts in your organization
     *
     * @param array|null $params Search parameters.
     * @return ReceiptSearchResult JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function all(?array $params = null): ReceiptSearchResult
    {
        return ReceiptSearchResult::fromArray($this->client->get('receipts', $params));
    }

    /**
     * Get a Receipt by ID
     *
     * @param string $id Receipt ID.
     * @return Receipt JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function retrieve(string $id): Receipt
    {
        return Receipt::fromArray($this->client->get('receipts/' . $id));
    }

    /**
     * Create a Receipt in your organization
     *
     * @param array $params Receipt payload.
     * @return Receipt JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function create(array $params): Receipt
    {
        return Receipt::fromArray($this->client->post('receipts', $params));
    }


    /**
     * Creates an invoice for a Receipt
     *
     * @param string $id Receipt ID.
     * @param array $params Invoice payload.
     * @return Invoice JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function invoice(string $id, array $params): Invoice
    {
        return Invoice::fromArray($this->client->post('receipts/' . $id . '/invoice', $params));
    }

    /**
     * Creates a global invoice from the open receipts in the last completed period
     *
     * @param array $params Global invoice payload.
     * @return Invoice JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function createGlobalInvoice(array $params): Invoice
    {
        return Invoice::fromArray($this->client->post('receipts/global-invoice', $params));
    }

    /**
     * Creates a single invoice using a list of receipt keys
     *
     * @param $data Array of properties and property values for creating an invoice from multiple receipts
     *
     * @return Invoice The created invoice object
     *
     * @throws FacturapiException
     */
    public function toInvoice(array $data): Invoice
    {
        try {
            return Invoice::fromArray($this->client->post('receipts/to-invoice', $data));
        } catch (FacturapiException $e) {
            throw new FacturapiException('Unable to create invoice: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Generates an invoice PDF preview for multiple receipts without stamping or saving it
     *
     * @param array $data Array of properties and property values for generating an invoice PDF preview
     *
     * @return string PDF file contents
     *
     * @throws FacturapiException
     */
    public function previewToInvoicePdf(array $data): string
    {
        return $this->client->postRaw('receipts/to-invoice/preview', $data);
    }

    /**
     * Obtains a signed download URL to preview an invoice for multiple receipts
     *
     * @param array $params Payload for invoice preview
     * @return SignedDownloadUrl
     * @throws FacturapiException
     */
    public function previewToInvoiceDownloadUrl(array $params): SignedDownloadUrl
    {
        return SignedDownloadUrl::fromArray($this->client->post('receipts/to-invoice/preview/download-url', $params));
    }

    /**
     * Cancel a Receipt
     *
     * @param string $id Receipt ID.
     * @return Receipt JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function cancel(string $id): Receipt
    {
        return Receipt::fromArray($this->client->delete('receipts/' . $id));
    }

    /**
     * Sends the receipt to the customer's email
     *
     * @param string $id Receipt ID.
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

        return SuccessResponse::fromArray($this->client->post('receipts/' . $id . '/email', $payload));
    }

    /**
     * @deprecated Use sendByEmail() instead. Will be removed in v5.
     */
    public function send_by_email(string $id, string|array|null $email = null): SuccessResponse
    {
        trigger_error('Receipts::send_by_email() is deprecated and will be removed in v5. Use sendByEmail() instead.', E_USER_DEPRECATED);
        return $this->sendByEmail($id, $email);
    }

    /**
     * Downloads the specified receipt in a PDF file
     *
     * @param string $id Receipt ID.
     * @return string Raw PDF bytes (binary string, not base64-encoded).
     *
     * @throws FacturapiException
     */
    public function downloadPdf(string $id): string
    {
        return $this->client->download('receipts/' . $id . '/pdf');
    }

    /**
     * @deprecated Use downloadPdf() instead. Will be removed in v5.
     */
    public function download_pdf(string $id): string
    {
        trigger_error('Receipts::download_pdf() is deprecated and will be removed in v5. Use downloadPdf() instead.', E_USER_DEPRECATED);
        return $this->downloadPdf($id);
    }
}
