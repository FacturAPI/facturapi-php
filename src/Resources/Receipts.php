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
   * @return JSON a receipt search result object
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
	 * @return Response The Receipt object we just created
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
	 * @param $params Array of properties and property values for invoicing a receipt
	 *
	 * @return Response The Invoice object of the invoice we just created
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
	 * Creates a global invoice from the open receipts in the last completed period
	 *
	 * @param $params Array of properties and property values for creating a global invoice
	 *
	 * @return Response the Invoice object of the global invoice we just created
	 *
	 * @throws Facturapi_Exception
	 *
	 */
	public function createGlobalInvoice( $params ) {
		try {
			return json_decode( $this->execute_JSON_post_request( $this->get_request_url() . "/global-invoice", $params ) );
		} catch ( Facturapi_Exception $e ) {
			throw new Facturapi_Exception( 'Unable to create global invoice: ' . $e );
		}
	}

	/**
	 * Cancel a Receipt
	 *
	 * @param $id : Unique ID for the Receipt
	 *
	 * @return Response the Receipt object
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