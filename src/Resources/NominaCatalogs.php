<?php

namespace Facturapi\Resources;

use Facturapi\Http\BaseClient;
use Facturapi\Exceptions\FacturapiException;

class NominaCatalogs extends BaseClient
{
    public function searchDeductions($params = null): mixed
    {
        return $this->search('deductions', $params);
    }

    public function searchPerceptions($params = null): mixed
    {
        return $this->search('perceptions', $params);
    }

    private function search(string $path, $params): mixed
    {
        try {
            return json_decode($this->executeGetRequest($this->getRequestUrl($path, $params)));
        } catch (FacturapiException $e) {
            throw $e;
        }
    }
}
