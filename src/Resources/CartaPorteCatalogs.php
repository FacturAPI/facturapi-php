<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class CartaPorteCatalogs extends BaseClient
{
    protected string $ENDPOINT = 'catalogs/cartaporte/3.1';

    /**
     * Air transport codes (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchAirTransportCodes($params = null): mixed
    {
        try {
            return json_decode(
                $this->executeGetRequest(
                    $this->getRequestUrl("air-transport-codes", $params)
                )
            );
        } catch (FacturapiException $e) {
            throw $e;
        }
    }

    /**
     * Auto transport configurations (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchTransportConfigs($params = null): mixed
    {
        try {
            return json_decode(
                $this->executeGetRequest(
                    $this->getRequestUrl("transport-configs", $params)
                )
            );
        } catch (FacturapiException $e) {
            throw $e;
        }
    }

    /**
     * Rights of passage (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchRightsOfPassage($params = null): mixed
    {
        try {
            return json_decode(
                $this->executeGetRequest(
                    $this->getRequestUrl("rights-of-passage", $params)
                )
            );
        } catch (FacturapiException $e) {
            throw $e;
        }
    }

    /**
     * Customs documents (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchCustomsDocuments($params = null): mixed
    {
        try {
            return json_decode(
                $this->executeGetRequest(
                    $this->getRequestUrl("customs-documents", $params)
                )
            );
        } catch (FacturapiException $e) {
            throw $e;
        }
    }

    /**
     * Packaging types (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchPackagingTypes($params = null): mixed
    {
        try {
            return json_decode(
                $this->executeGetRequest(
                    $this->getRequestUrl("packaging-types", $params)
                )
            );
        } catch (FacturapiException $e) {
            throw $e;
        }
    }

    /**
     * Trailer types (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchTrailerTypes($params = null): mixed
    {
        try {
            return json_decode(
                $this->executeGetRequest(
                    $this->getRequestUrl("trailer-types", $params)
                )
            );
        } catch (FacturapiException $e) {
            throw $e;
        }
    }

    /**
     * Hazardous materials (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchHazardousMaterials($params = null): mixed
    {
        try {
            return json_decode(
                $this->executeGetRequest(
                    $this->getRequestUrl("hazardous-materials", $params)
                )
            );
        } catch (FacturapiException $e) {
            throw $e;
        }
    }

    /**
     * Naval authorizations (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchNavalAuthorizations($params = null): mixed
    {
        try {
            return json_decode(
                $this->executeGetRequest(
                    $this->getRequestUrl("naval-authorizations", $params)
                )
            );
        } catch (FacturapiException $e) {
            throw $e;
        }
    }

    /**
     * Port stations (air/sea/land) (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchPortStations($params = null): mixed
    {
        try {
            return json_decode(
                $this->executeGetRequest(
                    $this->getRequestUrl("port-stations", $params)
                )
            );
        } catch (FacturapiException $e) {
            throw $e;
        }
    }

    /**
     * Marine containers (Carta Porte 3.1)
     *
     * @param array|null $params Search parameters.
     * @return mixed JSON-decoded response.
     * @throws FacturapiException
     */
    public function searchMarineContainers($params = null): mixed
    {
        try {
            return json_decode(
                $this->executeGetRequest(
                    $this->getRequestUrl("marine-containers", $params)
                )
            );
        } catch (FacturapiException $e) {
            throw $e;
        }
    }
}
