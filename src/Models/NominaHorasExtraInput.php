<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaHorasExtraInput
{
    public function __construct(
        public int $dias,
        public string $tipo_horas,
        public int $horas_extra,
        public float $importe_pagado,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['dias'] ?? 0,
            $data['tipo_horas'] ?? '',
            $data['horas_extra'] ?? 0,
            $data['importe_pagado'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'dias' => $this->dias,
            'tipo_horas' => $this->tipo_horas,
            'horas_extra' => $this->horas_extra,
            'importe_pagado' => $this->importe_pagado
        ], fn (string|int|float $v): true => $v !== null);
    }
}
