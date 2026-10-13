<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaPercepcionesProperties
{
    public function __construct(

        /** @var \Facturapi\Models\NominaPercepcionProperties[]|null */
        public ?array $percepcion = null,
        public ?\Facturapi\Models\NominaJubilacionProperties $jubilacion_pension_retiro = null,
        public ?\Facturapi\Models\NominaSeparacionProperties $separacion_indemnizacion = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['percepcion']) && is_array($data['percepcion']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NominaPercepcionProperties::fromArray($i) : $i, $data['percepcion']) : [],
            isset($data['jubilacion_pension_retiro']) && is_array($data['jubilacion_pension_retiro']) ? \Facturapi\Models\NominaJubilacionProperties::fromArray($data['jubilacion_pension_retiro']) : null,
            isset($data['separacion_indemnizacion']) && is_array($data['separacion_indemnizacion']) ? \Facturapi\Models\NominaSeparacionProperties::fromArray($data['separacion_indemnizacion']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'percepcion' => $this->percepcion !== null ? array_map(fn (\Facturapi\Models\NominaPercepcionProperties $i): array => $i->toArray(), $this->percepcion) : null,
            'jubilacion_pension_retiro' => $this->jubilacion_pension_retiro?->toArray(),
            'separacion_indemnizacion' => $this->separacion_indemnizacion?->toArray()
        ], fn (?array $v): bool => $v !== null);
    }
}
