<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class Invoices extends BaseClient {
	protected string $ENDPOINT = 'invoices';


	/**
	 * Get all Invoices
	 *
	 * @param array|null $query Query parameters.
	 * @return mixed JSON-decoded response.
	 * @throws FacturapiException
	 */
	public function all( $query = null ): mixed {
		try {
			return json_decode( $this->executeGetRequest( $this->getRequestUrl( $query ) ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * Get an Invoice by ID
	 *
	 * @param string $id Invoice ID.
	 * @return mixed JSON-decoded response.
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
	 * Create an Invoice in your organization
	 *
	 * @param array $body Invoice payload.
	 * @param array|null $query Query parameters.
	 * @return mixed JSON-decoded response.
	 * @throws FacturapiException
	 */
	public function create( $body, $query = null): mixed {
		try {
			return json_decode( $this->executeJsonPostRequest( $this->getRequestUrl($query), $body) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}


	/**
	 * Cancel an Invoice in your organization
	 *
	 * @param string $id Invoice ID.
	 * @param array $query URL query parameters.
	 * @return mixed JSON-decoded response.
	 * @throws FacturapiException
	 */
	public function cancel( $id, $query ): mixed {
		try {
			return json_decode( $this->executeDeleteRequest( $this->getRequestUrl( $id, $query ), null ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * Sends the invoice to the customer's email
	 *
	 * @param string $id Invoice ID.
	 * @param string|array|null $email Email or list of emails.
	 * @return mixed JSON-decoded response.
	 * @throws FacturapiException
	 */
	public function sendByEmail( $id, $email = null ): mixed {
		try {
			return json_decode( $this->executeJsonPostRequest(
				$this->getRequestUrl($id) . "/email",
				array("email" => $email)
			));
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use sendByEmail() instead. Will be removed in v5.
	 */
	public function send_by_email( $id, $email = null ): mixed {
		trigger_error('Invoices::send_by_email() is deprecated and will be removed in v5. Use sendByEmail() instead.', E_USER_DEPRECATED);
		return $this->sendByEmail( $id, $email );
	}

	/**
	 * Downloads the specified invoice in a ZIP package containing both PDF and XML files
	 *
	 * @param string $id Invoice ID.
	 * @return string ZIP file contents.
	 * @throws FacturapiException
	 */
	public function downloadZip( $id ): string {
		try {
			return $this->executeGetRequest( $this->getRequestUrl( $id ) . "/zip" );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use downloadZip() instead. Will be removed in v5.
	 */
	public function download_zip( $id ): string {
		trigger_error('Invoices::download_zip() is deprecated and will be removed in v5. Use downloadZip() instead.', E_USER_DEPRECATED);
		return $this->downloadZip( $id );
	}

	/**
	 * Downloads the specified invoice in a PDF file
	 *
	 * @param string $id Invoice ID.
	 * @return string Raw PDF bytes (binary string, not base64-encoded).
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
		trigger_error('Invoices::download_pdf() is deprecated and will be removed in v5. Use downloadPdf() instead.', E_USER_DEPRECATED);
		return $this->downloadPdf( $id );
	}

	/**
	 * Downloads the specified invoice in a XML file
	 *
	 * @param string $id Invoice ID.
	 * @return string XML file contents.
	 * @throws FacturapiException
	 */
	public function downloadXml( $id ): string {
		try {
			return $this->executeGetRequest( $this->getRequestUrl( $id ) . "/xml" );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use downloadXml() instead. Will be removed in v5.
	 */
	public function download_xml( $id ): string {
		trigger_error('Invoices::download_xml() is deprecated and will be removed in v5. Use downloadXml() instead.', E_USER_DEPRECATED);
		return $this->downloadXml( $id );
	}

	/**
	 * Downloads the cancellation receipt of a canceled invoice in XML format
	 *
	 * @param string $id Invoice ID.
	 * @return string XML file contents.
	 * @throws FacturapiException
	 */
	public function downloadCancellationReceiptXml( $id ): string {
		try {
			return $this->executeGetRequest( $this->getRequestUrl( $id . "/cancellation_receipt/xml" ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use downloadCancellationReceiptXml() instead. Will be removed in v5.
	 */
	public function download_cancellation_receipt_xml( $id ): string {
		trigger_error('Invoices::download_cancellation_receipt_xml() is deprecated and will be removed in v5. Use downloadCancellationReceiptXml() instead.', E_USER_DEPRECATED);
		return $this->downloadCancellationReceiptXml( $id );
	}

	/**
	 * Downloads the cancellation receipt of a canceled invoice in PDF format
	 *
	 * @param string $id Invoice ID.
	 * @return string PDF file contents.
	 *
	 * @throws FacturapiException
	 */
	public function downloadCancellationReceiptPdf( $id ): string {
		try {
			return $this->executeGetRequest( $this->getRequestUrl( $id ) . "/cancellation_receipt/pdf" );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use downloadCancellationReceiptPdf() instead. Will be removed in v5.
	 */
	public function download_cancellation_receipt_pdf( $id ): string {
		trigger_error('Invoices::download_cancellation_receipt_pdf() is deprecated and will be removed in v5. Use downloadCancellationReceiptPdf() instead.', E_USER_DEPRECATED);
		return $this->downloadCancellationReceiptPdf( $id );
	}

	/**
	 * Updates the status of an Invoice with the latest information from the SAT.
	 * In Test mode, this method will simulate a status update to a "canceled" status.
	 *
	 * @param string $id Invoice ID.
	 * @return mixed JSON-decoded response.
	 * @throws FacturapiException
	 */
	public function updateStatus( $id ): mixed {
		try {
			return json_decode( $this->executeJsonPutRequest( $this->getRequestUrl( $id . "/status" ), null ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use updateStatus() instead. Will be removed in v5.
	 */
	public function update_status( $id ): mixed {
		trigger_error('Invoices::update_status() is deprecated and will be removed in v5. Use updateStatus() instead.', E_USER_DEPRECATED);
		return $this->updateStatus( $id );
	}

	/**
	 * Updates an Invoice with "draft" status
	 *
	 * @param string $id Invoice ID.
	 * @param array $body Draft payload.
	 * @return mixed JSON-decoded response.
	 * @throws FacturapiException
	 */
	public function updateDraft( $id, $body ): mixed {
		try {
			return json_decode( $this->executeJsonPutRequest( $this->getRequestUrl( $id ), $body ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use updateDraft() instead. Will be removed in v5.
	 */
	public function update_draft( $id, $body ): mixed {
		trigger_error('Invoices::update_draft() is deprecated and will be removed in v5. Use updateDraft() instead.', E_USER_DEPRECATED);
		return $this->updateDraft( $id, $body );
	}

	/**
	 * Stamps a draft invoice
	 *
	 * @param string $id Invoice ID.
	 * @param array|null $query URL query parameters.
	 * @return mixed JSON-decoded response.
	 * @throws FacturapiException
	 */
	public function stampDraft( $id, $query = null ): mixed {
		try {
			return json_decode( $this->executeJsonPostRequest( $this->getRequestUrl( $id . "/stamp", $query ) ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use stampDraft() instead. Will be removed in v5.
	 */
	public function stamp_draft( $id, $query = null ): mixed {
		trigger_error('Invoices::stamp_draft() is deprecated and will be removed in v5. Use stampDraft() instead.', E_USER_DEPRECATED);
		return $this->stampDraft( $id, $query );
	}

	/**
	 * Creates a new draft Invoice copying the information from the specified Invoice
	 *
	 * @param string $id Invoice ID.
	 * @return mixed JSON-decoded response.
	 * @throws FacturapiException
	 */
	public function copyToDraft( $id ): mixed {
		try {
			return json_decode( $this->executeJsonPostRequest( $this->getRequestUrl( $id . "/copy" ), null ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use copyToDraft() instead. Will be removed in v5.
	 */
	public function copy_to_draft( $id ): mixed {
		trigger_error('Invoices::copy_to_draft() is deprecated and will be removed in v5. Use copyToDraft() instead.', E_USER_DEPRECATED);
		return $this->copyToDraft( $id );
	}

	/**
	 * Generates a preview of an invoice in PDF format without stamping it or saving it
	 *
	 * @param array $body Invoice payload.
	 * @return string PDF file contents.
	 * @throws FacturapiException
	 */
	public function previewPdf( $body ): string {
		try {
			return $this->executeJsonPostRequest( $this->getRequestUrl( "preview/pdf" ), $body );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * @deprecated Use previewPdf() instead. Will be removed in v5.
	 */
	public function preview_pdf( $body ): string {
		trigger_error('Invoices::preview_pdf() is deprecated and will be removed in v5. Use previewPdf() instead.', E_USER_DEPRECATED);
		return $this->previewPdf( $body );
	}
}
