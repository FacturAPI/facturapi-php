<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteRemolque
{
    public function __construct(
        public ?string $SubTipoRem = null,
        public ?string $Placa = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['SubTipoRem'] ?? null,
            $data['Placa'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'SubTipoRem' => $this->SubTipoRem,
            'Placa' => $this->Placa
        ], fn (?string $v): bool => $v !== null);
    }
}
