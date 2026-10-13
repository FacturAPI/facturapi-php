<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteTransporteMaritimo
{
    public function __construct(
        public string $PermSCT,
        public string $NumPermisoSCT,
        public ?string $NombreAseg = null,
        public ?string $NumPolizaSeguro = null,
        public ?string $TipoEmbarcacion = null,
        public ?string $Matricula = null,
        public ?string $NumeroOMI = null,
        public ?string $AnioEmbarcacion = null,
        public ?string $NombreEmbarc = null,
        public ?string $NacionalidadEmbarc = null,
        public ?float $UnidadesDeArqBruto = null,
        public ?string $TipoCarga = null,
        public ?float $Eslora = null,
        public ?float $Manga = null,
        public ?float $Calado = null,
        public ?float $Puntal = null,
        public ?string $LineaNaviera = null,
        public ?string $NombreAgenteNaviero = null,
        public ?string $NumAutorizacionNaviero = null,
        public ?string $NumViaje = null,
        public ?string $NumConocEmbarc = null,
        public ?string $PermisoTempNavegacion = null,

        /** @var \Facturapi\Models\CartaPorteContenedorMaritimo[]|null */
        public ?array $Contenedor = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['PermSCT'] ?? '',
            $data['NumPermisoSCT'] ?? '',
            $data['NombreAseg'] ?? null,
            $data['NumPolizaSeguro'] ?? null,
            $data['TipoEmbarcacion'] ?? null,
            $data['Matricula'] ?? null,
            $data['NumeroOMI'] ?? null,
            $data['AnioEmbarcacion'] ?? null,
            $data['NombreEmbarc'] ?? null,
            $data['NacionalidadEmbarc'] ?? null,
            $data['UnidadesDeArqBruto'] ?? 0,
            $data['TipoCarga'] ?? null,
            $data['Eslora'] ?? 0,
            $data['Manga'] ?? 0,
            $data['Calado'] ?? 0,
            $data['Puntal'] ?? 0,
            $data['LineaNaviera'] ?? null,
            $data['NombreAgenteNaviero'] ?? null,
            $data['NumAutorizacionNaviero'] ?? null,
            $data['NumViaje'] ?? null,
            $data['NumConocEmbarc'] ?? null,
            $data['PermisoTempNavegacion'] ?? null,
            isset($data['Contenedor']) && is_array($data['Contenedor']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CartaPorteContenedorMaritimo::fromArray($i) : $i, $data['Contenedor']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'PermSCT' => $this->PermSCT,
            'NumPermisoSCT' => $this->NumPermisoSCT,
            'NombreAseg' => $this->NombreAseg,
            'NumPolizaSeguro' => $this->NumPolizaSeguro,
            'TipoEmbarcacion' => $this->TipoEmbarcacion,
            'Matricula' => $this->Matricula,
            'NumeroOMI' => $this->NumeroOMI,
            'AnioEmbarcacion' => $this->AnioEmbarcacion,
            'NombreEmbarc' => $this->NombreEmbarc,
            'NacionalidadEmbarc' => $this->NacionalidadEmbarc,
            'UnidadesDeArqBruto' => $this->UnidadesDeArqBruto,
            'TipoCarga' => $this->TipoCarga,
            'Eslora' => $this->Eslora,
            'Manga' => $this->Manga,
            'Calado' => $this->Calado,
            'Puntal' => $this->Puntal,
            'LineaNaviera' => $this->LineaNaviera,
            'NombreAgenteNaviero' => $this->NombreAgenteNaviero,
            'NumAutorizacionNaviero' => $this->NumAutorizacionNaviero,
            'NumViaje' => $this->NumViaje,
            'NumConocEmbarc' => $this->NumConocEmbarc,
            'PermisoTempNavegacion' => $this->PermisoTempNavegacion,
            'Contenedor' => $this->Contenedor !== null ? array_map(fn (\Facturapi\Models\CartaPorteContenedorMaritimo $i): array => $i->toArray(), $this->Contenedor) : null
        ], fn (string|float|array|null $v): bool => $v !== null);
    }
}
