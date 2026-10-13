<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaHorasExtraProperties
{
    public function __construct(
        public ?int $dias = null,
        public ?string $tipo_horas = null,
        public ?int $horas_extra = null,
        public ?float $importe_pagado = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['dias'] ?? 0,
            $data['tipo_horas'] ?? null,
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
        ], fn (string|int|float|null $v): bool => $v !== null);
    }
}
