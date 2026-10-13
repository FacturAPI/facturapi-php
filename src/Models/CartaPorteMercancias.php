<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteMercancias
{
    public function __construct(
        public float $PesoBrutoTotal,
        public string $UnidadPeso,
        public ?float $PesoNetoTotal = null,
        public float $NumTotalMercancias = 0.0,
        public ?float $CargoPorTasacion = null,
        public ?string $LogisticaInversaRecoleccionDevolucion = null,

        /** @var \Facturapi\Models\CartaPorteMercancia[]|null */
        public array $Mercancia = [],
        public ?\Facturapi\Models\CartaPorteAutotransporte $Autotransporte = null,
        public ?\Facturapi\Models\CartaPorteTransporteMaritimo $TransporteMaritimo = null,
        public ?\Facturapi\Models\CartaPorteTransporteAereo $TransporteAereo = null,
        public ?\Facturapi\Models\CartaPorteTransporteFerroviario $TransporteFerroviario = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['PesoBrutoTotal'] ?? 0,
            $data['UnidadPeso'] ?? '',
            $data['PesoNetoTotal'] ?? 0,
            $data['NumTotalMercancias'] ?? 0,
            $data['CargoPorTasacion'] ?? 0,
            $data['LogisticaInversaRecoleccionDevolucion'] ?? null,
            isset($data['Mercancia']) && is_array($data['Mercancia']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CartaPorteMercancia::fromArray($i) : $i, $data['Mercancia']) : [],
            isset($data['Autotransporte']) && is_array($data['Autotransporte']) ? \Facturapi\Models\CartaPorteAutotransporte::fromArray($data['Autotransporte']) : null,
            isset($data['TransporteMaritimo']) && is_array($data['TransporteMaritimo']) ? \Facturapi\Models\CartaPorteTransporteMaritimo::fromArray($data['TransporteMaritimo']) : null,
            isset($data['TransporteAereo']) && is_array($data['TransporteAereo']) ? \Facturapi\Models\CartaPorteTransporteAereo::fromArray($data['TransporteAereo']) : null,
            isset($data['TransporteFerroviario']) && is_array($data['TransporteFerroviario']) ? \Facturapi\Models\CartaPorteTransporteFerroviario::fromArray($data['TransporteFerroviario']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'PesoBrutoTotal' => $this->PesoBrutoTotal,
            'UnidadPeso' => $this->UnidadPeso,
            'PesoNetoTotal' => $this->PesoNetoTotal,
            'NumTotalMercancias' => $this->NumTotalMercancias,
            'CargoPorTasacion' => $this->CargoPorTasacion,
            'LogisticaInversaRecoleccionDevolucion' => $this->LogisticaInversaRecoleccionDevolucion,
            'Mercancia' => $this->Mercancia !== null ? array_map(fn (\Facturapi\Models\CartaPorteMercancia $i): array => $i->toArray(), $this->Mercancia) : null,
            'Autotransporte' => $this->Autotransporte?->toArray(),
            'TransporteMaritimo' => $this->TransporteMaritimo?->toArray(),
            'TransporteAereo' => $this->TransporteAereo?->toArray(),
            'TransporteFerroviario' => $this->TransporteFerroviario?->toArray()
        ], fn (float|string|array|null $v): bool => $v !== null);
    }
}
