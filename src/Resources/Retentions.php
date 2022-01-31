<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Retentions extends BaseClient {
	protected $ENDPOINT = 'retentions';


	/**
	 * Search Retentions
	 *
	 * @param Search parameters
	 *
	 * @return JSON search result object
	 *
	 * @throws Facturapi_Exception
	 **/
	public function all( $params = null ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $params ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get Retentions: ' . $e );
		}
	}

	/**
	 * Get a Retention by ID
	 *
	 * @param id : Retention ID
	 *
	 * @return JSON Retention object
	 *
	 * @throws Facturapi_Exception
	 **/
	public function retrieve( $id ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $id ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get Retention: ' . $e );
		}
	}

	/**
	 * Creates a Retention for the organization
	 *
	 * @param params : array of properties and property values for new Retention
	 *
	 * @return Response body with JSON object with created Retention
	 *
	 * @throws Facturapi_Exception
	 **/
	public function create( $params ) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url(), $params ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to create Retention: ' . $e );
		}
	}


	/**
	 * Cancels a Retention
	 *
	 * @param id : Retention ID
	 *
	 * @return Response Updated Retention object
	 *
	 * @throws Facturapi_Exception
	 **/
	public function cancel( $id ) {
		try {
			return json_decode( $this->execute_delete_request( $this->get_request_url( $id ), null ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to cancel Retention: ' . $e );
		}
	}

	/**
	 * Sends the retention to the customer's email
	 *
	 * @param id : Retention ID
   * 
   * @param email : String or array of strings with email address(es)
	 *
	 * @return JSON Result object
	 *
	 * @throws Facturapi_Exception
	 **/
	public function send_by_email( $id, $email = null ) {
		try {
			return json_decode( $this->execute_JSON_post_request(
				$this->get_request_url($id) . "/email",
				array("email" => $email)
			));
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to send Retention: ' . $e );
		}
	}

	/**
	 * Downloads the specified Retention in a ZIP package containing both PDF and XML files
	 *
	 * @param id : Retention ID
	 *
	 * @return ZIP file in a stream
	 *
	 * @throws Facturapi_Exception
	 **/
	public function download_zip( $id ) {
		try {
			return $this->execute_get_request( $this->get_request_url( $id ) . "/zip" );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to download ZIP file: ' . $e );
		}
	}

	/**
	 * Downloads the specified Retention in a PDF file
	 *
	 * @param id : Retention ID
	 *
	 * @return PDF file in a stream
	 *
	 * @throws Facturapi_Exception
	 **/
	public function download_pdf( $id ) {
		try {
			return $this->execute_get_request( $this->get_request_url( $id ) . "/pdf" );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to download PDF file: ' . $e );
		}
	}

	/**
	 * Downloads the specified Retention in a XML file
	 *
	 * @param id : Retention ID
	 *
	 * @return XML file in a stream
	 *
	 * @throws Facturapi_Exception
	 **/
	public function download_xml( $id ) {
		try {
			return $this->execute_get_request( $this->get_request_url( $id ) . "/xml" );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to download XML file: ' . $e );
		}
	}
}