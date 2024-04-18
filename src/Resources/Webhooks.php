<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Webhooks extends BaseClient {
	protected $ENDPOINT = 'webhooks';

	/**
	 * Get all Webhooks
	 *
	 * @param Search parameters
	 *
	 * @return JSON objects for all Webhooks
	 *
	 * @throws Facturapi_Exception
	 **/
	public function all( $params = null ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $params ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get webhooks: ' . $e->getMessage() );
		}
	}

	/**
	 * Get a Webhook by ID
	 *
	 * @param id : Unique ID for webhook
	 *
	 * @return JSON object for requested Webhook
	 *
	 * @throws Facturapi_Exception
	 **/
	public function retrieve( $id ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $id ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get webhook: ' . $e->getMessage() );
		}
	}

	/**
	 * Create a Webhook in your organization
	 *
	 * @param params : array of properties and property values for new webhook
	 *
	 * @return Response body with JSON object
	 * for created Webhook from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function create( $params ) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url(), $params ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to create webhook: ' . $e->getMessage() );
		}
	}


	/**
	 * Update a Webhook in your organization
	 *
	 * @param $id
	 * @param $params array of properties and property values for webhook
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
			throw new Facturapi_Exception( 'Unable to update webhook: ' . $e->getMessage() );
		}
	}

	/**
	 * Delete a Webhook in your organization
	 *
	 * @param id : Unique ID for the webhook
	 *
	 * @return Response body from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function delete( $id ) {
		try {
			return json_decode( $this->execute_delete_request( $this->get_request_url( $id ), null ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to delete webhook: ' . $e->getMessage() );
		}
	}

}