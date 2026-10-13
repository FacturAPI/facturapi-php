<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaDeduccionProperties
{
    public function __construct(
        public ?string $tipo_deduccion = null,
        public ?string $concepto = null,
        public ?string $clave = null,
        public ?float $importe = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['tipo_deduccion'] ?? null,
            $data['concepto'] ?? null,
            $data['clave'] ?? null,
            $data['importe'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'tipo_deduccion' => $this->tipo_deduccion,
            'concepto' => $this->concepto,
            'clave' => $this->clave,
            'importe' => $this->importe
        ], fn (string|float|null $v): bool => $v !== null);
    }
}
