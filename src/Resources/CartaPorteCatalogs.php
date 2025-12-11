<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class CartaPorteCatalogs extends BaseClient
{
    protected $ENDPOINT = 'catalogs/cartaporte/3.1';

    /**
     * Air transport codes (Carta Porte 3.1)
     * @param $params Search parameters
     * @return JSON search result
     * @throws Facturapi_Exception
     */
    public function searchAirTransportCodes($params = null)
    {
        try {
            return json_decode(
                $this->execute_get_request(
                    $this->get_request_url("air-transport-codes") . $this->array_to_params($params)
                )
            );
        } catch (Facturapi_Exception $e) {
            throw new Facturapi_Exception('Unable to search air transport codes: ' . $e->getMessage());
        }
    }

    /**
     * Auto transport configurations (Carta Porte 3.1)
     */
    public function searchTransportConfigs($params = null)
    {
        try {
            return json_decode(
                $this->execute_get_request(
                    $this->get_request_url("transport-configs") . $this->array_to_params($params)
                )
            );
        } catch (Facturapi_Exception $e) {
            throw new Facturapi_Exception('Unable to search transport configurations: ' . $e->getMessage());
        }
    }

    /**
     * Rights of passage (Carta Porte 3.1)
     */
    public function searchRightsOfPassage($params = null)
    {
        try {
            return json_decode(
                $this->execute_get_request(
                    $this->get_request_url("rights-of-passage") . $this->array_to_params($params)
                )
            );
        } catch (Facturapi_Exception $e) {
            throw new Facturapi_Exception('Unable to search rights of passage: ' . $e->getMessage());
        }
    }

    /**
     * Customs documents (Carta Porte 3.1)
     */
    public function searchCustomsDocuments($params = null)
    {
        try {
            return json_decode(
                $this->execute_get_request(
                    $this->get_request_url("customs-documents") . $this->array_to_params($params)
                )
            );
        } catch (Facturapi_Exception $e) {
            throw new Facturapi_Exception('Unable to search customs documents: ' . $e->getMessage());
        }
    }

    /**
     * Packaging types (Carta Porte 3.1)
     */
    public function searchPackagingTypes($params = null)
    {
        try {
            return json_decode(
                $this->execute_get_request(
                    $this->get_request_url("packaging-types") . $this->array_to_params($params)
                )
            );
        } catch (Facturapi_Exception $e) {
            throw new Facturapi_Exception('Unable to search packaging types: ' . $e->getMessage());
        }
    }

    /**
     * Trailer types (Carta Porte 3.1)
     */
    public function searchTrailerTypes($params = null)
    {
        try {
            return json_decode(
                $this->execute_get_request(
                    $this->get_request_url("trailer-types") . $this->array_to_params($params)
                )
            );
        } catch (Facturapi_Exception $e) {
            throw new Facturapi_Exception('Unable to search trailer types: ' . $e->getMessage());
        }
    }

    /**
     * Hazardous materials (Carta Porte 3.1)
     */
    public function searchHazardousMaterials($params = null)
    {
        try {
            return json_decode(
                $this->execute_get_request(
                    $this->get_request_url("hazardous-materials") . $this->array_to_params($params)
                )
            );
        } catch (Facturapi_Exception $e) {
            throw new Facturapi_Exception('Unable to search hazardous materials: ' . $e->getMessage());
        }
    }

    /**
     * Naval authorizations (Carta Porte 3.1)
     */
    public function searchNavalAuthorizations($params = null)
    {
        try {
            return json_decode(
                $this->execute_get_request(
                    $this->get_request_url("naval-authorizations") . $this->array_to_params($params)
                )
            );
        } catch (Facturapi_Exception $e) {
            throw new Facturapi_Exception('Unable to search naval authorizations: ' . $e->getMessage());
        }
    }

    /**
     * Port stations (air/sea/land) (Carta Porte 3.1)
     */
    public function searchPortStations($params = null)
    {
        try {
            return json_decode(
                $this->execute_get_request(
                    $this->get_request_url("port-stations") . $this->array_to_params($params)
                )
            );
        } catch (Facturapi_Exception $e) {
            throw new Facturapi_Exception('Unable to search port stations: ' . $e->getMessage());
        }
    }

    /**
     * Marine containers (Carta Porte 3.1)
     */
    public function searchMarineContainers($params = null)
    {
        try {
            return json_decode(
                $this->execute_get_request(
                    $this->get_request_url("marine-containers") . $this->array_to_params($params)
                )
            );
        } catch (Facturapi_Exception $e) {
            throw new Facturapi_Exception('Unable to search marine containers: ' . $e->getMessage());
        }
    }
}
