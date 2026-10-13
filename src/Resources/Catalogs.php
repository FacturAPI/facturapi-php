<?php

declare(strict_types=1);

namespace Facturapi\Resources;

use Facturapi\Http\FacturapiHttpClient;
use Facturapi\Exceptions\FacturapiException;

class Catalogs
{
    public function __construct(private readonly FacturapiHttpClient $client)
    {
    }

    /**
     * Search a product key in SAT's catalog
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function searchProducts(?array $params = null): mixed
    {
        return $this->client->get('catalogs/products', $params);
    }

    /**
     * Search a unit key in SAT's catalog
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     *
     * @throws FacturapiException
     */
    public function searchUnits(?array $params = null): mixed
    {
        return $this->client->get('catalogs/units', $params);
    }
}
