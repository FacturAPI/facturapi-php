<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class Catalogs extends BaseClient
{
	protected string $ENDPOINT = 'catalogs';

	/**
	 * Search a product key in SAT's catalog
	 *
	 * @param array|null $params Search parameters.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function searchProducts($params = null): mixed
	{
		try {
			return json_decode(
				$this->executeGetRequest(
					$this->getRequestUrl("products", $params)
				)
			);
		} catch (FacturapiException $e) {
			throw $e;
		}
	}

	/**
	 * Search a unit key in SAT's catalog
	 *
	 * @param array|null $params Search parameters.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function searchUnits($params = null): mixed
	{
		try {
			return json_decode(
				$this->executeGetRequest(
					$this->getRequestUrl("units", $params)
				)
			);
		} catch (FacturapiException $e) {
			throw $e;
		}
	}
}
