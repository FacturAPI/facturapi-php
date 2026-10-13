<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ComercioExteriorDescripcionesEspecificas
{
    public function __construct(
        public string $Marca,
        public ?string $Modelo = null,
        public ?string $SubModelo = null,
        public ?string $NumeroSerie = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['Marca'] ?? '',
            $data['Modelo'] ?? null,
            $data['SubModelo'] ?? null,
            $data['NumeroSerie'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Marca' => $this->Marca,
            'Modelo' => $this->Modelo,
            'SubModelo' => $this->SubModelo,
            'NumeroSerie' => $this->NumeroSerie
        ], fn (?string $v): bool => $v !== null);
    }
}
