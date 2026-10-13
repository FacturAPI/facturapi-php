<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteCantidadTransporta
{
    public function __construct(
        public float $Cantidad,
        public string $IDOrigen,
        public string $IDDestino,
        public ?string $CvesTransporte = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['Cantidad'] ?? 0,
            $data['IDOrigen'] ?? '',
            $data['IDDestino'] ?? '',
            $data['CvesTransporte'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Cantidad' => $this->Cantidad,
            'IDOrigen' => $this->IDOrigen,
            'IDDestino' => $this->IDDestino,
            'CvesTransporte' => $this->CvesTransporte
        ], fn (float|string|null $v): bool => $v !== null);
    }
}
