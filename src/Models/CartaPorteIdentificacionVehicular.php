<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteIdentificacionVehicular
{
    public function __construct(
        public ?string $ConfigVehicular = null,
        public ?float $PesoBrutoVehicular = null,
        public ?string $PlacaVM = null,
        public ?string $AnioModeloVM = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['ConfigVehicular'] ?? null,
            $data['PesoBrutoVehicular'] ?? 0,
            $data['PlacaVM'] ?? null,
            $data['AnioModeloVM'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'ConfigVehicular' => $this->ConfigVehicular,
            'PesoBrutoVehicular' => $this->PesoBrutoVehicular,
            'PlacaVM' => $this->PlacaVM,
            'AnioModeloVM' => $this->AnioModeloVM
        ], fn (float|string|null $v): bool => $v !== null);
    }
}
