<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteDomicilio
{
    public function __construct(
        public ?string $Calle = null,
        public ?string $NumeroExterior = null,
        public ?string $NumeroInterior = null,
        public ?string $Colonia = null,
        public ?string $Localidad = null,
        public ?string $Referencia = null,
        public ?string $Municipio = null,
        public string $Estado = '',
        public string $Pais = '',
        public string $CodigoPostal = '',
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['Calle'] ?? null,
            $data['NumeroExterior'] ?? null,
            $data['NumeroInterior'] ?? null,
            $data['Colonia'] ?? null,
            $data['Localidad'] ?? null,
            $data['Referencia'] ?? null,
            $data['Municipio'] ?? null,
            $data['Estado'] ?? '',
            $data['Pais'] ?? '',
            $data['CodigoPostal'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Calle' => $this->Calle,
            'NumeroExterior' => $this->NumeroExterior,
            'NumeroInterior' => $this->NumeroInterior,
            'Colonia' => $this->Colonia,
            'Localidad' => $this->Localidad,
            'Referencia' => $this->Referencia,
            'Municipio' => $this->Municipio,
            'Estado' => $this->Estado,
            'Pais' => $this->Pais,
            'CodigoPostal' => $this->CodigoPostal
        ], fn (?string $v): bool => $v !== null);
    }
}
