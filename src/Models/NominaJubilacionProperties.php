<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaJubilacionProperties
{
    public function __construct(
        public ?float $total_una_exhibicion = null,
        public ?float $total_parcialidad = null,
        public ?float $monto_diario = null,
        public ?float $ingreso_acumulable = null,
        public ?float $ingreso_no_acumulable = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['total_una_exhibicion'] ?? 0,
            $data['total_parcialidad'] ?? 0,
            $data['monto_diario'] ?? 0,
            $data['ingreso_acumulable'] ?? 0,
            $data['ingreso_no_acumulable'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'total_una_exhibicion' => $this->total_una_exhibicion,
            'total_parcialidad' => $this->total_parcialidad,
            'monto_diario' => $this->monto_diario,
            'ingreso_acumulable' => $this->ingreso_acumulable,
            'ingreso_no_acumulable' => $this->ingreso_no_acumulable
        ], fn (?float $v): bool => $v !== null);
    }
}
