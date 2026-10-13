<?php

declare(strict_types=1);

namespace Facturapi\Resources;

use Facturapi\Http\FacturapiHttpClient;
use Facturapi\Exceptions\FacturapiException;

class ComercioExteriorCatalogs
{
    public function __construct(private readonly FacturapiHttpClient $client)
    {
    }

    /**
     * Search tariff fractions (Fracciones Arancelarias).
     *
     * @param array|null $params Search parameters (e.g., ["q" => "0101", "page" => 0, "limit" => 10])
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchTariffFractions(?array $params = null): mixed
    {
        return $this->client->get('catalogs/comercioexterior/2.0/tariff-fractions', $params);
    }
}
