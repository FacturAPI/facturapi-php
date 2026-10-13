<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaSubContratacionProperties
{
    public function __construct(
        public ?string $rfc_labora = null,
        public ?float $porcentaje_tiempo = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['rfc_labora'] ?? null,
            $data['porcentaje_tiempo'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'rfc_labora' => $this->rfc_labora,
            'porcentaje_tiempo' => $this->porcentaje_tiempo
        ], fn (string|float|null $v): bool => $v !== null);
    }
}
