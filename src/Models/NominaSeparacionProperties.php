<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaSeparacionProperties
{
    public function __construct(
        public ?float $total_pagado = null,
        public ?int $num_anos_servicio = null,
        public ?float $ultimo_sueldo_mens_ord = null,
        public ?float $ingreso_acumulable = null,
        public ?float $ingreso_no_acumulable = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['total_pagado'] ?? 0,
            $data['num_anos_servicio'] ?? 0,
            $data['ultimo_sueldo_mens_ord'] ?? 0,
            $data['ingreso_acumulable'] ?? 0,
            $data['ingreso_no_acumulable'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'total_pagado' => $this->total_pagado,
            'num_anos_servicio' => $this->num_anos_servicio,
            'ultimo_sueldo_mens_ord' => $this->ultimo_sueldo_mens_ord,
            'ingreso_acumulable' => $this->ingreso_acumulable,
            'ingreso_no_acumulable' => $this->ingreso_no_acumulable
        ], fn (int|float|null $v): bool => $v !== null);
    }
}
