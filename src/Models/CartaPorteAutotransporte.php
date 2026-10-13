<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteAutotransporte
{
    public function __construct(
        public ?string $PermSCT = null,
        public ?string $NumPermisoSCT = null,
        public ?\Facturapi\Models\CartaPorteIdentificacionVehicular $IdentificacionVehicular = null,
        public ?\Facturapi\Models\CartaPorteSeguros $Seguros = null,

        /** @var \Facturapi\Models\CartaPorteRemolque[]|null */
        public ?array $Remolques = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['PermSCT'] ?? null,
            $data['NumPermisoSCT'] ?? null,
            isset($data['IdentificacionVehicular']) && is_array($data['IdentificacionVehicular']) ? \Facturapi\Models\CartaPorteIdentificacionVehicular::fromArray($data['IdentificacionVehicular']) : null,
            isset($data['Seguros']) && is_array($data['Seguros']) ? \Facturapi\Models\CartaPorteSeguros::fromArray($data['Seguros']) : null,
            isset($data['Remolques']) && is_array($data['Remolques']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CartaPorteRemolque::fromArray($i) : $i, $data['Remolques']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'PermSCT' => $this->PermSCT,
            'NumPermisoSCT' => $this->NumPermisoSCT,
            'IdentificacionVehicular' => $this->IdentificacionVehicular?->toArray(),
            'Seguros' => $this->Seguros?->toArray(),
            'Remolques' => $this->Remolques !== null ? array_map(fn (\Facturapi\Models\CartaPorteRemolque $i): array => $i->toArray(), $this->Remolques) : null
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
