<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteDataProperties
{
    public function __construct(
        public string $IdCCP,
        public string $TranspInternac,
        public ?string $EntradaSalidaMerc = null,
        public ?string $PaisOrigenDestino = null,
        public ?string $ViaEntradaSalida = null,
        public ?float $TotalDistRec = null,
        public ?string $RegistroISTMO = null,
        public ?string $UbicacionPoloOrigen = null,
        public ?string $UbicacionPoloDestino = null,
        public ?array $RegimenesAduaneros = null,
        public array $Ubicaciones = [],
        public ?\Facturapi\Models\CartaPorteMercancias $Mercancias = null,
        public ?array $FiguraTransporte = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['IdCCP'] ?? '',
            $data['TranspInternac'] ?? '',
            $data['EntradaSalidaMerc'] ?? null,
            $data['PaisOrigenDestino'] ?? null,
            $data['ViaEntradaSalida'] ?? null,
            $data['TotalDistRec'] ?? 0,
            $data['RegistroISTMO'] ?? null,
            $data['UbicacionPoloOrigen'] ?? null,
            $data['UbicacionPoloDestino'] ?? null,
            $data['RegimenesAduaneros'] ?? [],
            $data['Ubicaciones'] ?? [],
            isset($data['Mercancias']) && is_array($data['Mercancias']) ? \Facturapi\Models\CartaPorteMercancias::fromArray($data['Mercancias']) : null,
            $data['FiguraTransporte'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'IdCCP' => $this->IdCCP,
            'TranspInternac' => $this->TranspInternac,
            'EntradaSalidaMerc' => $this->EntradaSalidaMerc,
            'PaisOrigenDestino' => $this->PaisOrigenDestino,
            'ViaEntradaSalida' => $this->ViaEntradaSalida,
            'TotalDistRec' => $this->TotalDistRec,
            'RegistroISTMO' => $this->RegistroISTMO,
            'UbicacionPoloOrigen' => $this->UbicacionPoloOrigen,
            'UbicacionPoloDestino' => $this->UbicacionPoloDestino,
            'RegimenesAduaneros' => $this->RegimenesAduaneros,
            'Ubicaciones' => $this->Ubicaciones,
            'Mercancias' => $this->Mercancias?->toArray(),
            'FiguraTransporte' => $this->FiguraTransporte
        ], fn (float|string|array|null $v): bool => $v !== null);
    }
}
