<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\Facturapi_Exception;

class Invoices extends BaseClient {
	protected $ENDPOINT = 'invoices';


	/**
	 * Get all Invoices
	 * @param query Array of query parameters for the search
	 * @return JSON objects for all Invoices
	 * @throws Facturapi_Exception
	 **/
	public function all( $query = null ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $query ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get Invoices: ' . $e->getMessage() );
		}
	}

	/**
	 * Get an Invoice by ID
	 * @param id : Unique ID for Invoice
	 * @return JSON object for requested Invoice
	 * @throws Facturapi_Exception
	 **/
	public function retrieve( $id ) {
		try {
			return json_decode( $this->execute_get_request( $this->get_request_url( $id ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to get Invoice: ' . $e->getMessage());
		}
	}

	/**
	 * Create an Invoice in your organization
	 *
	 * @param body : array of properties and property values for new Invoice
	 * @param query : array of query parameters
	 * @return Response body with JSON object
	 * for created Invoice from HTTP POST request
	 * @throws Facturapi_Exception
	 **/
	public function create( $body, $query = null) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url($query), $body) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to create Invoice: ' . $e->getMessage());
		}
	}


	/**
	 * Cancel an Invoice in your organization
	 * @param id : Unique ID for the Invoice
	 * @param query URL query params
	 * @return Response body from HTTP POST request
	 * @throws Facturapi_Exception
	 **/
	public function cancel( $id, $query ) {
		try {
			return json_decode( $this->execute_delete_request( $this->get_request_url( $id, $query ), null ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to cancel Invoice: ' . $e->getMessage());
		}
	}

	/**
	 * Sends the invoice to the customer's email
	 * @param id : Unique ID for Invoice
	 * @return JSON object for requested Invoice
	 * @throws Facturapi_Exception
	 **/
	public function send_by_email( $id, $email = null ) {
		try {
			return json_decode( $this->execute_JSON_post_request(
				$this->get_request_url($id) . "/email",
				array("email" => $email)
			));
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to send Invoice: ' . $e->getMessage());
		}
	}

	/**
	 * Downloads the specified invoice in a ZIP package containing both PDF and XML files
	 * @param id : Unique ID for Invoice
	 * @return ZIP file in a stream
	 * @throws Facturapi_Exception
	 **/
	public function download_zip( $id ) {
		try {
			return $this->execute_get_request( $this->get_request_url( $id ) . "/zip" );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to download ZIP file: ' . $e->getMessage());
		}
	}

	/**
	 * Downloads the specified invoice in a PDF file
	 * @param id : Unique ID for Invoice
	 * @return PDF file in a stream
	 * @throws Facturapi_Exception
	 **/
	public function download_pdf( $id ) {
		try {
			return $this->execute_get_request( $this->get_request_url( $id ) . "/pdf" );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to download PDF file: ' . $e->getMessage());
		}
	}

	/**
	 * Downloads the specified invoice in a XML file
	 * @param id : Unique ID for Invoice
	 * @return XML file in a stream
	 * @throws Facturapi_Exception
	 **/
	public function download_xml( $id ) {
		try {
			return $this->execute_get_request( $this->get_request_url( $id ) . "/xml" );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to download XML file: ' . $e->getMessage());
		}
	}

	/**
	 * Downloads the cancellation receipt of a canceled invoice in XML format
	 * @param id : Unique ID for Invoice
	 * @return XML file in a stream
	 * @throws Facturapi_Exception
	 **/
	public function download_cancellation_receipt_xml( $id ) {
		try {
			return $this->execute_get_request( $this->get_request_url( $id . "/cancellation_receipt/xml" ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to download cancellation receipt: ' . $e->getMessage());
		}
	}

		/**
	 * Downloads the cancellation receipt of a canceled invoice in PDF format
	 *
	 * @param id : Unique ID for Invoice
	 *
	 * @return XML file in a stream
	 *
	 * @throws Facturapi_Exception
	 **/
	public function download_cancellation_receipt_pdf( $id ) {
		try {
			return $this->execute_get_request( $this->get_request_url( $id ) . "/cancellation_receipt/pdf" );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to download cancellation receipt: ' . $e->getMessage());
		}
	}

	/**
	 * Updates the status of an Invoice with the latest information from the SAT.
	 * In Test mode, this method will simulate a status update to a "canceled" status.
	 * @param id : Unique ID for Invoice
	 * @return JSON Updated Invoice object
	 * @throws Facturapi_Exception
	 */
	public function update_status( $id ) {
		try {
			return json_decode( $this->execute_JSON_put_request( $this->get_request_url( $id . "/status" ), null ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to update status: ' . $e );
		}
	}

	/**
	 * Updates an Invoice with "draft" status
	 * 
	 * @param id : Unique ID for Invoice
	 * @param body : array of properties and property values for the fields to edit
	 * @return JSON Edited draft Invoice object
	 * @throws Facturapi_Exception
	 */
	public function update_draft( $id, $body ) {
		try {
			return json_decode( $this->execute_JSON_put_request( $this->get_request_url( $id ), $body ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to edit draft: ' . $e );
		}
	}

	/**
	 * Stamps a draft invoice
	 * 
	 * @param id : Unique ID for Invoice
	 * @param query : URL query params
	 * @return JSON Stamped Invoice object
	 * @throws Facturapi_Exception
	 */ 
	public function stamp_draft( $id, $query = null ) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url( $id . "/stamp", $query ) ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to stamp draft: ' . $e );
		}
	}

	/**
	 * Creates a new draft Invoice copying the information from the specified Invoice
	 * @param id : Unique ID for Invoice
	 * @return JSON Copied draft Invoice object
	 * @throws Facturapi_Exception
	 */
	public function copy_to_draft( $id ) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url( $id . "/copy" ), null ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to copy draft: ' . $e );
		}
	}

	/**
	 * Generates a preview of an invoice in PDF format without stamping it or saving it
	 * @param array $body Array of properties and property values for new Invoice
	 * @return PDF file in a stream
	 * @throws Facturapi_Exception
	 **/
	public function preview_pdf( $body ) {
		try {
			return $this->execute_JSON_post_request( $this->get_request_url( "preview/pdf" ), $body );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to generate preview: ' . $e->getMessage());
		}
	}
}