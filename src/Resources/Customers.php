<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Customers extends BaseClient {
	protected $ENDPOINT = 'customers';
	protected $API_VERSION = 'v1';

	/**
	 * Get all Customers
	 *
	 * @param Search parameters
	 *
	 * @return JSON objects for all Customers
	 *
	 * @throws Facturapi_Exception
	 **/
	public function all( $params = null ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $params ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get customers: ' . $e );
		}
	}

	/**
	 * Get a Customer by ID
	 *
	 * @param id : Unique ID for customer
	 *
	 * @return JSON object for requested Customer
	 *
	 * @throws Facturapi_Exception
	 **/
	public function retrieve( $id ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $id ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get customer: ' . $e );
		}
	}

	/**
	 * Create a Customer in your organization
	 *
	 * @param params : array of properties and property values for new customer
	 *
	 * @return Response body with JSON object
	 * for created Customer from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function create( $params ) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url(), $params ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to create customer: ' . $e );
		}
	}


	/**
	 * Update a Customer in your organization
	 *
	 * @param $id
	 * @param $params array of properties and property values for customer
	 *
	 * @return Response body from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 *
	 */
	public function update( $id, $params ) {
		try {
			return json_decode( $this->execute_JSON_put_request( $this->get_request_url( $id ), $params ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to update customer: ' . $e );
		}
	}

	/**
	 * Delete a Customer in your organization
	 *
	 * @param id : Unique ID for the customer
	 *
	 * @return Response body from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function delete( $id ) {
		try {
			return json_decode( $this->execute_delete_request( $this->get_request_url( $id ), null ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to delete customer: ' . $e );
		}
	}

}