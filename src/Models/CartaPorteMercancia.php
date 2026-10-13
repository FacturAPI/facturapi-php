<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteMercancia
{
    public function __construct(
        public string $BienesTransp,
        public ?string $ClaveSTCC = null,
        public string $Descripcion = '',
        public float $Cantidad = 0.0,
        public string $ClaveUnidad = '',
        public ?string $Unidad = null,
        public ?string $Dimensiones = null,
        public ?string $MaterialPeligroso = null,
        public ?string $CveMaterialPeligroso = null,
        public ?string $Embalaje = null,
        public ?string $DescripEmbalaje = null,
        public ?string $SectorCOFEPRIS = null,
        public ?string $NombreIngredienteActivo = null,
        public ?string $NomQuimico = null,
        public ?string $DenominacionGenericaProd = null,
        public ?string $DenominacionDistintivaProd = null,
        public ?string $Fabricante = null,
        public ?string $FechaCaducidad = null,
        public ?string $LoteMedicamento = null,
        public ?string $FormaFarmaceutica = null,
        public ?string $CondicionesEspTransp = null,
        public ?string $RegistroSanitarioFolioAutorizacion = null,
        public ?string $PermisoImportacion = null,
        public ?string $FolioImpoVUCEM = null,
        public ?string $NumCAS = null,
        public ?string $RazonSocialEmpImp = null,
        public ?string $NumRegSanPlagCOFEPRIS = null,
        public ?string $DatosFabricante = null,
        public ?string $DatosFormulador = null,
        public ?string $DatosMaquilador = null,
        public ?string $UsoAutorizado = null,
        public float $PesoEnKg = 0.0,
        public ?float $ValorMercancia = null,
        public ?string $Moneda = null,
        public ?string $FraccionArancelaria = null,
        public ?string $UUIDComercioExt = null,
        public ?string $TipoMateria = null,
        public ?string $DescripcionMateria = null,

        /** @var \Facturapi\Models\CartaPorteDocumentacionAduanera[]|null */
        public ?array $DocumentacionAduanera = null,

        /** @var \Facturapi\Models\CartaPorteGuiaIdentificacion[]|null */
        public ?array $GuiasIdentificacion = null,

        /** @var \Facturapi\Models\CartaPorteCantidadTransporta[]|null */
        public ?array $CantidadTransporta = null,

        /** @var \Facturapi\Models\CartaPorteDetalleMercancia[]|null */
        public ?array $DetalleMercancia = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['BienesTransp'] ?? '',
            $data['ClaveSTCC'] ?? null,
            $data['Descripcion'] ?? '',
            $data['Cantidad'] ?? 0,
            $data['ClaveUnidad'] ?? '',
            $data['Unidad'] ?? null,
            $data['Dimensiones'] ?? null,
            $data['MaterialPeligroso'] ?? null,
            $data['CveMaterialPeligroso'] ?? null,
            $data['Embalaje'] ?? null,
            $data['DescripEmbalaje'] ?? null,
            $data['SectorCOFEPRIS'] ?? null,
            $data['NombreIngredienteActivo'] ?? null,
            $data['NomQuimico'] ?? null,
            $data['DenominacionGenericaProd'] ?? null,
            $data['DenominacionDistintivaProd'] ?? null,
            $data['Fabricante'] ?? null,
            $data['FechaCaducidad'] ?? null,
            $data['LoteMedicamento'] ?? null,
            $data['FormaFarmaceutica'] ?? null,
            $data['CondicionesEspTransp'] ?? null,
            $data['RegistroSanitarioFolioAutorizacion'] ?? null,
            $data['PermisoImportacion'] ?? null,
            $data['FolioImpoVUCEM'] ?? null,
            $data['NumCAS'] ?? null,
            $data['RazonSocialEmpImp'] ?? null,
            $data['NumRegSanPlagCOFEPRIS'] ?? null,
            $data['DatosFabricante'] ?? null,
            $data['DatosFormulador'] ?? null,
            $data['DatosMaquilador'] ?? null,
            $data['UsoAutorizado'] ?? null,
            $data['PesoEnKg'] ?? 0,
            $data['ValorMercancia'] ?? 0,
            $data['Moneda'] ?? null,
            $data['FraccionArancelaria'] ?? null,
            $data['UUIDComercioExt'] ?? null,
            $data['TipoMateria'] ?? null,
            $data['DescripcionMateria'] ?? null,
            isset($data['DocumentacionAduanera']) && is_array($data['DocumentacionAduanera']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CartaPorteDocumentacionAduanera::fromArray($i) : $i, $data['DocumentacionAduanera']) : [],
            isset($data['GuiasIdentificacion']) && is_array($data['GuiasIdentificacion']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CartaPorteGuiaIdentificacion::fromArray($i) : $i, $data['GuiasIdentificacion']) : [],
            isset($data['CantidadTransporta']) && is_array($data['CantidadTransporta']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CartaPorteCantidadTransporta::fromArray($i) : $i, $data['CantidadTransporta']) : [],
            isset($data['DetalleMercancia']) && is_array($data['DetalleMercancia']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CartaPorteDetalleMercancia::fromArray($i) : $i, $data['DetalleMercancia']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'BienesTransp' => $this->BienesTransp,
            'ClaveSTCC' => $this->ClaveSTCC,
            'Descripcion' => $this->Descripcion,
            'Cantidad' => $this->Cantidad,
            'ClaveUnidad' => $this->ClaveUnidad,
            'Unidad' => $this->Unidad,
            'Dimensiones' => $this->Dimensiones,
            'MaterialPeligroso' => $this->MaterialPeligroso,
            'CveMaterialPeligroso' => $this->CveMaterialPeligroso,
            'Embalaje' => $this->Embalaje,
            'DescripEmbalaje' => $this->DescripEmbalaje,
            'SectorCOFEPRIS' => $this->SectorCOFEPRIS,
            'NombreIngredienteActivo' => $this->NombreIngredienteActivo,
            'NomQuimico' => $this->NomQuimico,
            'DenominacionGenericaProd' => $this->DenominacionGenericaProd,
            'DenominacionDistintivaProd' => $this->DenominacionDistintivaProd,
            'Fabricante' => $this->Fabricante,
            'FechaCaducidad' => $this->FechaCaducidad,
            'LoteMedicamento' => $this->LoteMedicamento,
            'FormaFarmaceutica' => $this->FormaFarmaceutica,
            'CondicionesEspTransp' => $this->CondicionesEspTransp,
            'RegistroSanitarioFolioAutorizacion' => $this->RegistroSanitarioFolioAutorizacion,
            'PermisoImportacion' => $this->PermisoImportacion,
            'FolioImpoVUCEM' => $this->FolioImpoVUCEM,
            'NumCAS' => $this->NumCAS,
            'RazonSocialEmpImp' => $this->RazonSocialEmpImp,
            'NumRegSanPlagCOFEPRIS' => $this->NumRegSanPlagCOFEPRIS,
            'DatosFabricante' => $this->DatosFabricante,
            'DatosFormulador' => $this->DatosFormulador,
            'DatosMaquilador' => $this->DatosMaquilador,
            'UsoAutorizado' => $this->UsoAutorizado,
            'PesoEnKg' => $this->PesoEnKg,
            'ValorMercancia' => $this->ValorMercancia,
            'Moneda' => $this->Moneda,
            'FraccionArancelaria' => $this->FraccionArancelaria,
            'UUIDComercioExt' => $this->UUIDComercioExt,
            'TipoMateria' => $this->TipoMateria,
            'DescripcionMateria' => $this->DescripcionMateria,
            'DocumentacionAduanera' => $this->DocumentacionAduanera !== null ? array_map(fn (\Facturapi\Models\CartaPorteDocumentacionAduanera $i): array => $i->toArray(), $this->DocumentacionAduanera) : null,
            'GuiasIdentificacion' => $this->GuiasIdentificacion !== null ? array_map(fn (\Facturapi\Models\CartaPorteGuiaIdentificacion $i): array => $i->toArray(), $this->GuiasIdentificacion) : null,
            'CantidadTransporta' => $this->CantidadTransporta !== null ? array_map(fn (\Facturapi\Models\CartaPorteCantidadTransporta $i): array => $i->toArray(), $this->CantidadTransporta) : null,
            'DetalleMercancia' => $this->DetalleMercancia !== null ? array_map(fn (\Facturapi\Models\CartaPorteDetalleMercancia $i): array => $i->toArray(), $this->DetalleMercancia) : null
        ], fn (string|float|array|null $v): bool => $v !== null);
    }
}
