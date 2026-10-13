<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaComplementDataDirectProperties
{
    public function __construct(
        public ?string $tipo_nomina = null,
        public ?string $fecha_pago = null,
        public ?string $fecha_inicial_pago = null,
        public ?string $fecha_final_pago = null,
        public ?float $num_dias_pagados = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['tipo_nomina'] ?? null,
            $data['fecha_pago'] ?? null,
            $data['fecha_inicial_pago'] ?? null,
            $data['fecha_final_pago'] ?? null,
            $data['num_dias_pagados'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'tipo_nomina' => $this->tipo_nomina,
            'fecha_pago' => $this->fecha_pago,
            'fecha_inicial_pago' => $this->fecha_inicial_pago,
            'fecha_final_pago' => $this->fecha_final_pago,
            'num_dias_pagados' => $this->num_dias_pagados
        ], fn (string|float|null $v): bool => $v !== null);
    }
}
