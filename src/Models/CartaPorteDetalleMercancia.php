<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteDetalleMercancia
{
    public function __construct(
        public string $UnidadPesoMerc,
        public float $PesoBruto,
        public float $PesoNeto,
        public float $PesoTara,
        public ?float $NumPiezas = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['UnidadPesoMerc'] ?? '',
            $data['PesoBruto'] ?? 0,
            $data['PesoNeto'] ?? 0,
            $data['PesoTara'] ?? 0,
            $data['NumPiezas'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'UnidadPesoMerc' => $this->UnidadPesoMerc,
            'PesoBruto' => $this->PesoBruto,
            'PesoNeto' => $this->PesoNeto,
            'PesoTara' => $this->PesoTara,
            'NumPiezas' => $this->NumPiezas
        ], fn (string|float|null $v): bool => $v !== null);
    }
}
