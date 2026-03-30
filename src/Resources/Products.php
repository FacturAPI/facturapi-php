<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class Products extends BaseClient {
	protected string $ENDPOINT = 'products';


	/**
	 * Get all Products
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
	 * Get a Product by ID
	 *
	 * @param string $id Product ID.
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
	 * Create a Product in your organization
	 *
	 * @param array $params Product data.
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
	 * Update a Product in your organization
	 *
	 * @param string $id Product ID.
	 * @param array $params Product data.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function update( $id, $params ): mixed {
		try {
			return json_decode( $this->executeJsonPutRequest( $this->getRequestUrl( $id ), $params ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

	/**
	 * Delete a Product in your organization
	 *
	 * @param string $id Product ID.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function delete( $id ): mixed {
		try {
			return json_decode( $this->executeDeleteRequest( $this->getRequestUrl( $id ), null ) );
		} catch ( FacturapiException $e ) {
			throw $e;
		}
	}

}
