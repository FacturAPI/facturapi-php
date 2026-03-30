<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class Receipts extends BaseClient {
	protected string $ENDPOINT = 'receipts';


	/**
	 * Search or list all receipts in your organization
	 *
	 * @param array|null $params Search parameters.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function all( $params = null ): mixed {
		try {
			return json_decode( $this->executeGetRequest( $this->getRequestUrl( $params ) ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * Get a Receipt by ID
	 *
	 * @param string $id Receipt ID.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function retrieve( $id ): mixed {
		try {
			return json_decode( $this->executeGetRequest( $this->getRequestUrl( $id ) ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * Create a Receipt in your organization
	 *
	 * @param array $params Receipt payload.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function create( $params ): mixed {
		try {
			return json_decode( $this->executeJsonPostRequest( $this->getRequestUrl(), $params ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}


	/**
	 * Creates an invoice for a Receipt
	 *
	 * @param string $id Receipt ID.
	 * @param array $params Invoice payload.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function invoice( $id, $params ): mixed {
		try {
			return json_decode( $this->executeJsonPostRequest( $this->getRequestUrl( $id ) . "/invoice", $params ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * Creates a global invoice from the open receipts in the last completed period
	 *
	 * @param array $params Global invoice payload.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function createGlobalInvoice( $params ): mixed {
		try {
			return json_decode( $this->executeJsonPostRequest( $this->getRequestUrl() . "/global-invoice", $params ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * Cancel a Receipt
	 *
	 * @param string $id Receipt ID.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function cancel( $id ): mixed {
		try {
			return json_decode( $this->executeDeleteRequest( $this->getRequestUrl( $id ), null ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * Sends the receipt to the customer's email
	 *
	 * @param string $id Receipt ID.
	 * @param string|array|null $email Email or list of emails.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function sendByEmail( $id, $email = null ): mixed {
		try {
			return json_decode( $this->executeJsonPostRequest(
				$this->getRequestUrl($id) . "/email",
				$email == null ? null : array("email" => $email)
			));
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use sendByEmail() instead. Will be removed in v5.
	 */
	public function send_by_email( $id, $email = null ): mixed {
		trigger_error('Receipts::send_by_email() is deprecated and will be removed in v5. Use sendByEmail() instead.', E_USER_DEPRECATED);
		return $this->sendByEmail( $id, $email );
	}

	/**
	 * Downloads the specified receipt in a PDF file
	 *
	 * @param string $id Receipt ID.
	 * @return string Raw PDF bytes (binary string, not base64-encoded).
	 *
	 * @throws FacturapiException
	 */
	public function downloadPdf( $id ): string {
		try {
			return $this->executeGetRequest( $this->getRequestUrl( $id ) . "/pdf" );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use downloadPdf() instead. Will be removed in v5.
	 */
	public function download_pdf( $id ): string {
		trigger_error('Receipts::download_pdf() is deprecated and will be removed in v5. Use downloadPdf() instead.', E_USER_DEPRECATED);
		return $this->downloadPdf( $id );
	}
}
