<?php

declare(strict_types=1);

namespace Facturapi\Resources;

use Facturapi\Http\FacturapiHttpClient;
use Facturapi\Exceptions\FacturapiException;
use Facturapi\Models\Customer;
use Facturapi\Models\CustomerSearchResult;
use Facturapi\Models\OkResponse;
use Facturapi\Models\TaxIdValidationResult;

class Customers
{
    public function __construct(private readonly FacturapiHttpClient $client)
    {
    }

    /**
     * Get all Customers
     *
     * @param array|null $params Search parameters.
     *
     * @throws FacturapiException
     */
    public function all(?array $params = null): CustomerSearchResult
    {
        $response = $this->client->get('customers', $params);
        return CustomerSearchResult::fromArray($response);
    }

    /**
     * Get a Customer by ID
     *
     * @param string $id Customer ID.
     *
     * @throws FacturapiException
     */
    public function retrieve(string $id): Customer
    {
        $response = $this->client->get('customers/' . $id);
        return Customer::fromArray($response);
    }

    /**
     * Create a Customer in your organization
     *
     * @param array $data Customer data.
     * @param array|null $params Optional query parameters.
     *
     * @throws FacturapiException
     */
    public function create(array $data, ?array $params = null): Customer
    {
        $response = $this->client->post('customers', $data, $params);
        return Customer::fromArray($response);
    }


    /**
     * Update a Customer in your organization
     *
     * @param string $id Customer ID.
     * @param array $data Customer data.
     * @param array|null $params Optional query parameters.
     *
     * @throws FacturapiException
     */
    public function update(string $id, array $data, ?array $params = null): Customer
    {
        $response = $this->client->put('customers/' . $id, $data, $params);
        return Customer::fromArray($response);
    }

    /**
     * Delete a Customer in your organization
     *
     * @param string $id Customer ID.
     *
     * @throws FacturapiException
     */
    public function delete(string $id): Customer
    {
        $response = $this->client->delete('customers/' . $id);
        return Customer::fromArray($response);
    }

    /**
     * Validates that a Customer's tax info is still valid
     *
     * @param string $id Customer ID.
     *
     * @throws FacturapiException
     */
    public function validateTaxInfo(string $id): TaxIdValidationResult
    {
        $response = $this->client->get('customers/' . $id . '/tax-info-validation');
        return TaxIdValidationResult::fromArray($response);
    }

    /**
     * Send an edit link to the customer's email
     *
     * @param string $id Customer ID.
     * @param array<string, mixed> $data Data containing optional email.
     *
     * @throws FacturapiException
     */
    public function sendEditLink(string $id, array $data = []): OkResponse
    {
        $response = $this->client->post('customers/' . $id . '/email-edit-link', $data);
        return OkResponse::fromArray($response);
    }
}
