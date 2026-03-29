<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class Customers extends BaseClient {
	protected string $ENDPOINT = 'customers';

	/**
	 * Get all Customers
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
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}

	/**
	 * Get a Customer by ID
	 *
	 * @param string $id Customer ID.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function retrieve( $id ): mixed {
		try {
			return json_decode( $this->executeGetRequest( $this->getRequestUrl( $id ) ) );
		} catch ( FacturapiException $e ) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}

	/**
	 * Create a Customer in your organization
	 *
	 * @param array $data Customer data.
	 * @param array|null $params Optional query parameters.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function create( $data, $params = null ): mixed {
		try {
			return json_decode( $this->executeJsonPostRequest( $this->getRequestUrl($params), $data ) );
		} catch ( FacturapiException $e ) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}


	/**
	 * Update a Customer in your organization
	 *
	 * @param string $id Customer ID.
	 * @param array $data Customer data.
	 * @param array|null $params Optional query parameters.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function update( $id, $data, $params = null ): mixed {
		try {
			return json_decode( $this->executeJsonPutRequest( $this->getRequestUrl( $id, $params ), $data ) );
		} catch ( FacturapiException $e ) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}

	/**
	 * Delete a Customer in your organization
	 *
	 * @param string $id Customer ID.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function delete( $id ): mixed {
		try {
			return json_decode( $this->executeDeleteRequest( $this->getRequestUrl( $id ), null ) );
		} catch ( FacturapiException $e ) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}

	/**
	 * Validates that a Customer's tax info is still valid
	 *
	 * @param string $id Customer ID.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function validateTaxInfo( $id ): mixed {
		try {
			return json_decode( $this->executeGetRequest( $this->getRequestUrl( $id ) . "/tax-info-validation" ) );
		} catch ( FacturapiException $e ) {
			throw new FacturapiException($e->getMessage(), 0, $e);
		}
	}

}
