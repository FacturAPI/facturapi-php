<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaAccionesInput
{
    public function __construct(
        public float $valor_mercado,
        public float $precio_al_otorgarse,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['valor_mercado'] ?? 0,
            $data['precio_al_otorgarse'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'valor_mercado' => $this->valor_mercado,
            'precio_al_otorgarse' => $this->precio_al_otorgarse
        ], fn (float $v): true => $v !== null);
    }
}
