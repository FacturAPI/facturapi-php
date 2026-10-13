<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteContenedorFerroviario
{
    public function __construct(
        public ?string $TipoContenedor = null,
        public ?float $PesoContenedorVacio = null,
        public ?float $PesoNetoMercancia = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['TipoContenedor'] ?? null,
            $data['PesoContenedorVacio'] ?? 0,
            $data['PesoNetoMercancia'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'TipoContenedor' => $this->TipoContenedor,
            'PesoContenedorVacio' => $this->PesoContenedorVacio,
            'PesoNetoMercancia' => $this->PesoNetoMercancia
        ], fn (string|float|null $v): bool => $v !== null);
    }
}
