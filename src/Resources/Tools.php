<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Tools extends BaseClient {
	protected $ENDPOINT = 'tools';


	/**
	 * Validates a tax id
	 *
   * @param $params Search parameters
   *
   * @return JSON validation object
	 *
	 * @throws Facturapi_Exception
	 **/
	public function validateTaxId( $tax_id ) {
		try {
			return json_decode(
        $this->execute_get_request(
          $this->get_request_url( "tax_id_validation" ).$this->array_to_params(
            array(
              "tax_id" => $tax_id
            )
          )
        )
      );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Failed to validate tax id: ' . $e );
		}
	}

}