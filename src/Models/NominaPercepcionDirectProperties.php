<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaPercepcionDirectProperties
{
    public function __construct(
        public ?string $tipo_percepcion = null,
        public ?string $concepto = null,
        public ?string $clave = null,
        public ?float $importe_gravado = null,
        public ?float $importe_exento = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['tipo_percepcion'] ?? null,
            $data['concepto'] ?? null,
            $data['clave'] ?? null,
            $data['importe_gravado'] ?? 0,
            $data['importe_exento'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'tipo_percepcion' => $this->tipo_percepcion,
            'concepto' => $this->concepto,
            'clave' => $this->clave,
            'importe_gravado' => $this->importe_gravado,
            'importe_exento' => $this->importe_exento
        ], fn (string|float|null $v): bool => $v !== null);
    }
}
