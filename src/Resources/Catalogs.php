<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Catalogs extends BaseClient {
	protected $ENDPOINT = 'catalogs';
	protected $API_VERSION = 'v1';


	/**
	 * Search a product key in SAT's catalog
	 *
   * @param $params Search parameters
   *
   * @return JSON objects for all Receipts
	 *
	 * @throws Facturapi_Exception
	 **/
	public function searchProducts( $params = null ) {
		try {
			return json_decode(
        $this->execute_get_request(
          $this->get_request_url( "products" ) . $this->array_to_params($params)
        )
      );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to search products: ' . $e );
		}
	}

	/**
	 * Search a unit key in SAT's catalog
	 *
   * @param $params Search parameters
   *
   * @return JSON objects for all Receipts
	 *
	 * @throws Facturapi_Exception
	 **/
	public function searchUnits( $params = null ) {
		try {
			return json_decode(
        $this->execute_get_request(
          $this->get_request_url( "units" ) . $this->array_to_params($params)
        )
      );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to search unit keys: ' . $e );
		}
	}

}