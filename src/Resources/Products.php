<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Products extends BaseClient {
	protected $ENDPOINT = 'products';
	protected $API_VERSION = 'v1';


	/**
	 * Get all Products
	 *
	 * @param Search parameters
	 *
	 * @return JSON objects for all Products
	 *
	 * @throws Facturapi_Exception
	 **/
	public function all( $params = null ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $params ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get products: ' . $e );
		}
	}

	/**
	 * Get a Product by ID
	 *
	 * @param id : Unique ID for Product
	 *
	 * @return JSON object for requested Product
	 *
	 * @throws Facturapi_Exception
	 **/
	public function retrieve( $id ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $id ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get product: ' . $e );
		}
	}

	/**
	 * Create a Product in your organization
	 *
	 * @param params : array of properties and property values for new Product
	 *
	 * @return Response body with JSON object
	 * for created Product from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function create( $params ) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url(), $params ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to create product: ' . $e );
		}
	}


	/**
	 * Update a Product in your organization
	 *
	 * @param $id
	 * @param $params array of properties and property values for Product
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
			throw new Facturapi_Exception( 'Unable to update product: ' . $e );
		}
	}

	/**
	 * Delete a Product in your organization
	 *
	 * @param id : Unique ID for the Product
	 *
	 * @return Response body from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function delete( $id ) {
		try {
			return json_decode( $this->execute_delete_request( $this->get_request_url( $id ), null ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to delete product: ' . $e );
		}
	}

}