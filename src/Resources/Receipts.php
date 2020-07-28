<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Receipts extends BaseClient {
	protected $ENDPOINT = 'receipts';
	protected $API_VERSION = 'v1';


	/**
	 * Search or list all receipts in your organization
	 *
   * @param $params Search parameters
   *
   * @return JSON objects for all Receipts
	 *
	 * @throws Facturapi_Exception
	 **/
	public function all( $params = null ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $params ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get receipts: ' . $e );
		}
	}

	/**
	 * Get a Receipt by ID
	 *
	 * @param id : Unique ID for Receipt
	 *
	 * @return JSON object for requested Receipt
	 *
	 * @throws Facturapi_Exception
	 **/
	public function retrieve( $id ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $id ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get receipt: ' . $e );
		}
	}

	/**
	 * Create a Receipt in your organization
	 *
	 * @param params : array of properties and property values for new Receipt
	 *
	 * @return Response body with JSON object
	 * for created Receipt from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function create( $params ) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url(), $params ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to create receipt: ' . $e );
		}
	}


	/**
	 * Creates an invoice for a Receipt
	 *
	 * @param $id Receipt Id
	 * @param $params Array of properties and property values for Receipt
	 *
	 * @return Response body from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 *
	 */
	public function invoice( $id, $params ) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url( $id ) . "/invoice", $params ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to invoice receipt: ' . $e );
		}
	}

	/**
	 * Cancel a Receipt
	 *
	 * @param $id : Unique ID for the Receipt
	 *
	 * @return Response body from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function cancel( $id ) {
		try {
			return json_decode( $this->execute_delete_request( $this->get_request_url( $id ), null ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to cancel receipt: ' . $e );
		}
	}

}