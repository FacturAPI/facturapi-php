<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Invoices extends BaseClient {
	protected $ENDPOINT = 'invoices';


	/**
	 * Get all Invoices
	 *
	 * @param Search params
	 *
	 * @return JSON objects for all Invoices
	 *
	 * @throws Facturapi_Exception
	 **/
	public function all( $params = null ) {
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
	public function retrieve( $id ) {
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
	 * @param Search params
	 *
	 * @return Response body from HTTP POST request
	 *
	 * @throws Facturapi_Exception
	 **/
	public function cancel( $id, $params ) {
		try {
			return json_decode( $this->execute_delete_request( $this->get_request_url( $id, $params ), null ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to cancel Invoice: ' . $e );
		}
	}

	/**
	 * Sends the invoice to the customer's email
	 *
	 * @param id : Unique ID for Invoice
	 *
	 * @return JSON object for requested Invoice
	 *
	 * @throws Facturapi_Exception
	 **/
	public function send_by_email( $id, $email = null ) {
		try {
			return json_decode( $this->execute_JSON_post_request(
				$this->get_request_url($id) . "/email",
				$email == null ? array() : array("email" => $email)
			));
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to send Invoice: ' . $e );
		}
	}

	/**
	 * Downloads the specified invoice in a ZIP package containing both PDF and XML files
	 *
	 * @param id : Unique ID for Invoice
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
	 * Downloads the specified invoice in a PDF file
	 *
	 * @param id : Unique ID for Invoice
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
	 * Downloads the specified invoice in a XML file
	 *
	 * @param id : Unique ID for Invoice
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

	/**
	 * Downloads the cancellation receipt of a canceled invoice in XML format
	 *
	 * @param id : Unique ID for Invoice
	 *
	 * @return XML file in a stream
	 *
	 * @throws Facturapi_Exception
	 **/
	public function download_cancellation_receipt_xml( $id ) {
		try {
			return $this->execute_get_request( $this->get_request_url( $id ) . "/cancellation_receipt/xml" );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to download cancellation receipt: ' . $e );
		}
	}
}