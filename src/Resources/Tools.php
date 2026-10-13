<?php

declare(strict_types=1);

namespace Facturapi\Resources;

use Facturapi\Exceptions\FacturapiException;
use Facturapi\Http\FacturapiHttpClient;
use Facturapi\Models\OkResponse;
use Facturapi\Models\TaxIdValidationResult;

class Tools
{
    public function __construct(private readonly FacturapiHttpClient $client)
    {
    }

    /**
     * Validates a tax id
     *
     * @param string $tax_id Tax ID (RFC) to validate.
     * @return TaxIdValidationResult JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function validateTaxId(string $tax_id): TaxIdValidationResult
    {
        return TaxIdValidationResult::fromArray($this->client->get('tools/tax_id_validation', ['tax_id' => $tax_id]));
    }

    /**
     * Health check (Pulse)
     *
     * @return OkResponse JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function check(): OkResponse
    {
        return OkResponse::fromArray($this->client->get('check'));
    }
}
