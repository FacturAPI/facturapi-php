<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteTransporteAereo
{
    public function __construct(
        public ?string $PermSCT = null,
        public ?string $NumPermisoSCT = null,
        public ?string $MatriculaAeronave = null,
        public ?string $NombreAseg = null,
        public ?string $NumPolizaSeguro = null,
        public ?string $NumeroGuia = null,
        public ?string $LugarContrato = null,
        public ?string $CodigoTransportista = null,
        public ?string $RFCEmbarcador = null,
        public ?string $NumRegIdTribEmbarc = null,
        public ?string $ResidenciaFiscalEmbarc = null,
        public ?string $NombreEmbarcador = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['PermSCT'] ?? null,
            $data['NumPermisoSCT'] ?? null,
            $data['MatriculaAeronave'] ?? null,
            $data['NombreAseg'] ?? null,
            $data['NumPolizaSeguro'] ?? null,
            $data['NumeroGuia'] ?? null,
            $data['LugarContrato'] ?? null,
            $data['CodigoTransportista'] ?? null,
            $data['RFCEmbarcador'] ?? null,
            $data['NumRegIdTribEmbarc'] ?? null,
            $data['ResidenciaFiscalEmbarc'] ?? null,
            $data['NombreEmbarcador'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'PermSCT' => $this->PermSCT,
            'NumPermisoSCT' => $this->NumPermisoSCT,
            'MatriculaAeronave' => $this->MatriculaAeronave,
            'NombreAseg' => $this->NombreAseg,
            'NumPolizaSeguro' => $this->NumPolizaSeguro,
            'NumeroGuia' => $this->NumeroGuia,
            'LugarContrato' => $this->LugarContrato,
            'CodigoTransportista' => $this->CodigoTransportista,
            'RFCEmbarcador' => $this->RFCEmbarcador,
            'NumRegIdTribEmbarc' => $this->NumRegIdTribEmbarc,
            'ResidenciaFiscalEmbarc' => $this->ResidenciaFiscalEmbarc,
            'NombreEmbarcador' => $this->NombreEmbarcador
        ], fn (?string $v): bool => $v !== null);
    }
}
