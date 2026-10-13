<?php

declare(strict_types=1);

namespace Facturapi\Resources;

use Facturapi\Http\FacturapiHttpClient;

class NominaCatalogs
{
    public function __construct(private readonly FacturapiHttpClient $client)
    {
    }

    public function searchDeductions(?array $params = null): mixed
    {
        return $this->search('deductions', $params);
    }

    public function searchPerceptions(?array $params = null): mixed
    {
        return $this->search('perceptions', $params);
    }

    private function search(string $path, ?array $params): mixed
    {
        return $this->client->get('catalogs/nomina/' . $path, $params);
    }
}
