<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationSeriesUpdateInput
{
    public function __construct(
        public ?int $next_folio = null,
        public ?int $next_folio_test = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['next_folio'] ?? 0,
            $data['next_folio_test'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'next_folio' => $this->next_folio,
            'next_folio_test' => $this->next_folio_test
        ], fn (?int $v): bool => $v !== null);
    }
}
