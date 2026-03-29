<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class ComercioExteriorCatalogs extends BaseClient
{
    protected string $ENDPOINT = 'catalogs/comercioexterior/2.0';

    /**
     * Search tariff fractions (Fracciones Arancelarias).
     *
     * @param array|null $params Search parameters (e.g., ["q" => "0101", "page" => 0, "limit" => 10])
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchTariffFractions($params = null): mixed
    {
        try {
            return json_decode(
                $this->executeGetRequest(
                    $this->getRequestUrl("tariff-fractions", $params)
                )
            );
        } catch (FacturapiException $e) {
            throw new FacturapiException($e->getMessage(), 0, $e);
        }
    }
}
