<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Customers extends BaseClient {
	protected $ENDPOINT = 'customers';

	/**
	 * Get all Customers
	 *
	 * @param $params Search parameters
	 *
	 * @return JSON objects for all Customers
	 *
	 * @throws Facturapi_Exception
	 **/
	public function all( $params = null ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $params ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get customers: ' . $e->getMessage() );
		}
	}

	/**
	 * Get a Customer by ID
	 *
	 * @param string $id : Unique ID for customer
	 *
	 * @return JSON object for requested Customer
	 *
	 * @throws Facturapi_Exception
	 **/
	public function retrieve( $id ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $id ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get customer: ' . $e->getMessage() );
		}
	}

	/**
	 * Create a Customer in your organization
	 *
	 * @param $data : array of properties and property values for new customer
	 * @param $params : array of optional query parameters
	 *
	 * @return Response body with JSON object
	 * for created Customer from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function create( $data, $params = null ) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url($params), $data ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to create customer: ' . $e->getMessage() );
		}
	}


	/**
	 * Update a Customer in your organization
	 *
	 * @param string $id
	 * @param $data Array of properties and property values for customer
	 * @param $params Array of optional query parameters
	 *
	 * @return Response body from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 *
	 */
	public function update( $id, $data, $params = null ) {
		try {
			return json_decode( $this->execute_JSON_put_request( $this->get_request_url( $id, $params ), $data ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to update customer: ' . $e->getMessage() );
		}
	}

	/**
	 * Delete a Customer in your organization
	 *
	 * @param string $id : Unique ID for the customer
	 *
	 * @return Response body from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function delete( $id ) {
		try {
			return json_decode( $this->execute_delete_request( $this->get_request_url( $id ), null ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to delete customer: ' . $e->getMessage() );
		}
	}
	
	/**
	 * Validates that a Customer's tax info is still valid
	 *
	 * @param string $id : Unique ID for the customer
	 * @return Response body from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function validateTaxInfo( $id ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $id ) . "/tax-info-validation" ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to validate customer\'s tax info: ' . $e->getMessage() );
		}
	}

}