<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteCarroFerroviario
{
    public function __construct(
        public ?string $TipoCarro = null,
        public ?string $MatriculaCarro = null,
        public ?string $GuiaCarro = null,
        public ?float $ToneladasNetasCarro = null,

        /** @var \Facturapi\Models\CartaPorteContenedorFerroviario[]|null */
        public ?array $Contenedor = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['TipoCarro'] ?? null,
            $data['MatriculaCarro'] ?? null,
            $data['GuiaCarro'] ?? null,
            $data['ToneladasNetasCarro'] ?? 0,
            isset($data['Contenedor']) && is_array($data['Contenedor']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CartaPorteContenedorFerroviario::fromArray($i) : $i, $data['Contenedor']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'TipoCarro' => $this->TipoCarro,
            'MatriculaCarro' => $this->MatriculaCarro,
            'GuiaCarro' => $this->GuiaCarro,
            'ToneladasNetasCarro' => $this->ToneladasNetasCarro,
            'Contenedor' => $this->Contenedor !== null ? array_map(fn (\Facturapi\Models\CartaPorteContenedorFerroviario $i): array => $i->toArray(), $this->Contenedor) : null
        ], fn (string|float|array|null $v): bool => $v !== null);
    }
}
