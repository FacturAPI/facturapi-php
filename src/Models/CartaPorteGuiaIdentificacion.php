<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteGuiaIdentificacion
{
    public function __construct(
        public ?string $NumeroGuiaIdentificacion = null,
        public ?string $DescripGuiaIdentificacion = null,
        public ?float $PesoGuiaIdentificacion = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['NumeroGuiaIdentificacion'] ?? null,
            $data['DescripGuiaIdentificacion'] ?? null,
            $data['PesoGuiaIdentificacion'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'NumeroGuiaIdentificacion' => $this->NumeroGuiaIdentificacion,
            'DescripGuiaIdentificacion' => $this->DescripGuiaIdentificacion,
            'PesoGuiaIdentificacion' => $this->PesoGuiaIdentificacion
        ], fn (string|float|null $v): bool => $v !== null);
    }
}
