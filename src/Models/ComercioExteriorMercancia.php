<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ComercioExteriorMercancia
{
    public function __construct(

        /** @var \Facturapi\Models\ComercioExteriorDescripcionesEspecificas[]|null */
        public ?array $DescripcionesEspecificas = null,
        public string $NoIdentificacion = '',
        public ?string $FraccionArancelaria = null,
        public ?float $CantidadAduana = null,
        public ?string $UnidadAduana = null,
        public ?float $ValorUnitarioAduana = null,
        public float $ValorDolares = 0.0,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['DescripcionesEspecificas']) && is_array($data['DescripcionesEspecificas']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\ComercioExteriorDescripcionesEspecificas::fromArray($i) : $i, $data['DescripcionesEspecificas']) : [],
            $data['NoIdentificacion'] ?? '',
            $data['FraccionArancelaria'] ?? null,
            $data['CantidadAduana'] ?? 0,
            $data['UnidadAduana'] ?? null,
            $data['ValorUnitarioAduana'] ?? 0,
            $data['ValorDolares'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'DescripcionesEspecificas' => $this->DescripcionesEspecificas !== null ? array_map(fn (\Facturapi\Models\ComercioExteriorDescripcionesEspecificas $i): array => $i->toArray(), $this->DescripcionesEspecificas) : null,
            'NoIdentificacion' => $this->NoIdentificacion,
            'FraccionArancelaria' => $this->FraccionArancelaria,
            'CantidadAduana' => $this->CantidadAduana,
            'UnidadAduana' => $this->UnidadAduana,
            'ValorUnitarioAduana' => $this->ValorUnitarioAduana,
            'ValorDolares' => $this->ValorDolares
        ], fn (string|float|array|null $v): bool => $v !== null);
    }
}
