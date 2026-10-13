<?php

declare(strict_types=1);

namespace Facturapi\Resources;

use Facturapi\Http\FacturapiHttpClient;
use Facturapi\Exceptions\FacturapiException;

class CartaPorteCatalogs
{
    public function __construct(private readonly FacturapiHttpClient $client)
    {
    }

    /**
     * Air transport codes (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchAirTransportCodes(?array $params = null): mixed
    {
        return $this->client->get('catalogs/cartaporte/3.1/air-transport-codes', $params);
    }

    /**
     * Auto transport configurations (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchTransportConfigs(?array $params = null): mixed
    {
        return $this->client->get('catalogs/cartaporte/3.1/transport-configs', $params);
    }

    /**
     * Rights of passage (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchRightsOfPassage(?array $params = null): mixed
    {
        return $this->client->get('catalogs/cartaporte/3.1/rights-of-passage', $params);
    }

    /**
     * Customs documents (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchCustomsDocuments(?array $params = null): mixed
    {
        return $this->client->get('catalogs/cartaporte/3.1/customs-documents', $params);
    }

    /**
     * Packaging types (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchPackagingTypes(?array $params = null): mixed
    {
        return $this->client->get('catalogs/cartaporte/3.1/packaging-types', $params);
    }

    /**
     * Trailer types (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchTrailerTypes(?array $params = null): mixed
    {
        return $this->client->get('catalogs/cartaporte/3.1/trailer-types', $params);
    }

    /**
     * Hazardous materials (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchHazardousMaterials(?array $params = null): mixed
    {
        return $this->client->get('catalogs/cartaporte/3.1/hazardous-materials', $params);
    }

    /**
     * Naval authorizations (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchNavalAuthorizations(?array $params = null): mixed
    {
        return $this->client->get('catalogs/cartaporte/3.1/naval-authorizations', $params);
    }

    /**
     * Port stations (air/sea/land) (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchPortStations(?array $params = null): mixed
    {
        return $this->client->get('catalogs/cartaporte/3.1/port-stations', $params);
    }

    /**
     * Marine containers (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchMarineContainers(?array $params = null): mixed
    {
        return $this->client->get('catalogs/cartaporte/3.1/marine-containers', $params);
    }
}
