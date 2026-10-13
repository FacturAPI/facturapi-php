<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaOtroPagoDirectProperties
{
    public function __construct(
        public ?string $tipo_otro_pago = null,
        public ?string $clave = null,
        public ?string $concepto = null,
        public ?float $importe = null,
        public ?float $subsidio_causado = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['tipo_otro_pago'] ?? null,
            $data['clave'] ?? null,
            $data['concepto'] ?? null,
            $data['importe'] ?? 0,
            $data['subsidio_causado'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'tipo_otro_pago' => $this->tipo_otro_pago,
            'clave' => $this->clave,
            'concepto' => $this->concepto,
            'importe' => $this->importe,
            'subsidio_causado' => $this->subsidio_causado
        ], fn (string|float|null $v): bool => $v !== null);
    }
}
