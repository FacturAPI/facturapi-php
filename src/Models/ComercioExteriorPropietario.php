<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ComercioExteriorPropietario
{
    public function __construct(
        public string $NumRegIdTrib,
        public string $ResidenciaFiscal,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['NumRegIdTrib'] ?? '',
            $data['ResidenciaFiscal'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'NumRegIdTrib' => $this->NumRegIdTrib,
            'ResidenciaFiscal' => $this->ResidenciaFiscal
        ], fn (string $v): true => $v !== null);
    }
}
