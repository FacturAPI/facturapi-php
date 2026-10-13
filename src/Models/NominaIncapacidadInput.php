<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaIncapacidadInput
{
    public function __construct(
        public int $dias_incapacidad,
        public string $tipo_incapacidad,
        public ?float $importe_monetario = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['dias_incapacidad'] ?? 0,
            $data['tipo_incapacidad'] ?? '',
            $data['importe_monetario'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'dias_incapacidad' => $this->dias_incapacidad,
            'tipo_incapacidad' => $this->tipo_incapacidad,
            'importe_monetario' => $this->importe_monetario
        ], fn (int|string|float|null $v): bool => $v !== null);
    }
}
