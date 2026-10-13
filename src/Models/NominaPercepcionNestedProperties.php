<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaPercepcionNestedProperties
{
    public function __construct(
        public ?\Facturapi\Models\NominaAccionesProperties $acciones_o_titulos = null,

        /** @var \Facturapi\Models\NominaHorasExtraProperties[]|null */
        public ?array $horas_extra = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['acciones_o_titulos']) && is_array($data['acciones_o_titulos']) ? \Facturapi\Models\NominaAccionesProperties::fromArray($data['acciones_o_titulos']) : null,
            isset($data['horas_extra']) && is_array($data['horas_extra']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NominaHorasExtraProperties::fromArray($i) : $i, $data['horas_extra']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'acciones_o_titulos' => $this->acciones_o_titulos?->toArray(),
            'horas_extra' => $this->horas_extra !== null ? array_map(fn (\Facturapi\Models\NominaHorasExtraProperties $i): array => $i->toArray(), $this->horas_extra) : null
        ], fn (?array $v): bool => $v !== null);
    }
}
