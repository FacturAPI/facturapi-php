<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaAccionesProperties
{
    public function __construct(
        public ?float $valor_mercado = null,
        public ?float $precio_al_otorgarse = null,
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
        ], fn (?float $v): bool => $v !== null);
    }
}
