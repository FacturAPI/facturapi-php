<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteDerechosDePaso
{
    public function __construct(
        public ?string $TipoDerechoDePaso = null,
        public ?float $KilometrajePagado = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['TipoDerechoDePaso'] ?? null,
            $data['KilometrajePagado'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'TipoDerechoDePaso' => $this->TipoDerechoDePaso,
            'KilometrajePagado' => $this->KilometrajePagado
        ], fn (string|float|null $v): bool => $v !== null);
    }
}
