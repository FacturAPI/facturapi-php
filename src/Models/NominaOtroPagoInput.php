<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaOtroPagoInput
{
    public function __construct(
        public string $tipo_otro_pago,
        public string $clave,
        public ?string $concepto = null,
        public float $importe = 0.0,
        public ?float $subsidio_causado = null,
        public ?\Facturapi\Models\NominaCompensacionInput $compensacion_saldos_a_favor = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['tipo_otro_pago'] ?? '',
            $data['clave'] ?? '',
            $data['concepto'] ?? null,
            $data['importe'] ?? 0,
            $data['subsidio_causado'] ?? 0,
            isset($data['compensacion_saldos_a_favor']) && is_array($data['compensacion_saldos_a_favor']) ? \Facturapi\Models\NominaCompensacionInput::fromArray($data['compensacion_saldos_a_favor']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'tipo_otro_pago' => $this->tipo_otro_pago,
            'clave' => $this->clave,
            'concepto' => $this->concepto,
            'importe' => $this->importe,
            'subsidio_causado' => $this->subsidio_causado,
            'compensacion_saldos_a_favor' => $this->compensacion_saldos_a_favor?->toArray()
        ], fn (string|float|array|null $v): bool => $v !== null);
    }
}
