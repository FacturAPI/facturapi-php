<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteTransporteFerroviario
{
    public function __construct(
        public ?string $TipoDeServicio = null,
        public ?string $TipoDeTrafico = null,
        public ?string $NombreAseg = null,
        public ?string $NumPolizaSeguro = null,

        /** @var \Facturapi\Models\CartaPorteDerechosDePaso[]|null */
        public ?array $DerechosDePaso = null,

        /** @var \Facturapi\Models\CartaPorteCarroFerroviario[]|null */
        public ?array $Carro = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['TipoDeServicio'] ?? null,
            $data['TipoDeTrafico'] ?? null,
            $data['NombreAseg'] ?? null,
            $data['NumPolizaSeguro'] ?? null,
            isset($data['DerechosDePaso']) && is_array($data['DerechosDePaso']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CartaPorteDerechosDePaso::fromArray($i) : $i, $data['DerechosDePaso']) : [],
            isset($data['Carro']) && is_array($data['Carro']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CartaPorteCarroFerroviario::fromArray($i) : $i, $data['Carro']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'TipoDeServicio' => $this->TipoDeServicio,
            'TipoDeTrafico' => $this->TipoDeTrafico,
            'NombreAseg' => $this->NombreAseg,
            'NumPolizaSeguro' => $this->NumPolizaSeguro,
            'DerechosDePaso' => $this->DerechosDePaso !== null ? array_map(fn (\Facturapi\Models\CartaPorteDerechosDePaso $i): array => $i->toArray(), $this->DerechosDePaso) : null,
            'Carro' => $this->Carro !== null ? array_map(fn (\Facturapi\Models\CartaPorteCarroFerroviario $i): array => $i->toArray(), $this->Carro) : null
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
