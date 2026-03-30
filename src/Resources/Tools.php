<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class Tools extends BaseClient
{
	protected string $ENDPOINT = 'tools';

	/**
	 * Validates a tax id
	 *
	 * @param string $tax_id Tax ID (RFC) to validate.
	 * @return mixed JSON-decoded response.
	 *
	 * @throws FacturapiException
	 */
	public function validateTaxId($tax_id): mixed
	{
		try {
			return json_decode(
				$this->executeGetRequest(
					$this->getRequestUrl('tax_id_validation', array('tax_id' => $tax_id))
				)
			);
		} catch (FacturapiException $e) {
			throw $e;
		}
	}
}
