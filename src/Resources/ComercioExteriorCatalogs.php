<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class ComercioExteriorCatalogs extends BaseClient
{
    protected $ENDPOINT = 'catalogs/comercioexterior/2.0';

    /**
     * Search tariff fractions (Fracciones Arancelarias)
     * @param array|null $params Search parameters (e.g., ["q" => "0101", "page" => 0, "limit" => 10])
     * @return JSON search result
     * @throws Facturapi_Exception
     */
    public function searchTariffFractions($params = null)
    {
        try {
            return json_decode(
                $this->execute_get_request(
                    $this->get_request_url("tariff-fractions") . $this->array_to_params($params)
                )
            );
        } catch (Facturapi_Exception $e) {
            throw new Facturapi_Exception('Unable to search tariff fractions: ' . $e->getMessage());
        }
    }
}
