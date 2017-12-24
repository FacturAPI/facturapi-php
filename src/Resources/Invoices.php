<?php

namespace Facturapi\Resources;
require_once './Http/BaseClient.php';
require_once './Exceptions/Facturapi_Exception.php';

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Invoices extends BaseClient {
	protected $ENDPOINT = 'invoices';
	protected $API_VERSION = 'v1';


	/**
	 * Get all Invoices
	 *
	 * @param Search parameters
	 *
	 * @return JSON objects for all Invoices
	 *
	 * @throws Facturapi_Exception
	 **/
	public function get_all( $params = null ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $params ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get Invoices: ' . $e );
		}
	}

	/**
	 * Get an Invoice by ID
	 *
	 * @param id : Unique ID for Invoice
	 *
	 * @return JSON object for requested Invoice
	 *
	 * @throws Facturapi_Exception
	 **/
	public function get_by_id( $id ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $id ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get Invoice: ' . $e );
		}
	}

	/**
	 * Create an Invoice in your organization
	 *
	 * @param params : array of properties and property values for new Invoice
	 *
	 * @return Response body with JSON object
	 * for created Invoice from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function create( $params ) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url(), $params ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to create Invoice: ' . $e );
		}
	}


	/**
	 * Cancel an Invoice in your organization
	 *
	 * @param id : Unique ID for the Invoice
	 *
	 * @return Response body from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function cancel( $id ) {
		try {
			return json_decode( $this->execute_delete_request( $this->get_request_url( $id ), null ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to cancel Invoice: ' . $e );
		}
	}

}