<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationSeriesCreateInput
{
    public function __construct(
        public string $series,
        public int $next_folio,
        public int $next_folio_test,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['series'] ?? '',
            $data['next_folio'] ?? 0,
            $data['next_folio_test'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'series' => $this->series,
            'next_folio' => $this->next_folio,
            'next_folio_test' => $this->next_folio_test
        ], fn (string|int $v): true => $v !== null);
    }
}
