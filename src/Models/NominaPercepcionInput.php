<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaPercepcionInput
{
    public function __construct(
        public string $tipo_percepcion,
        public ?string $concepto = null,
        public string $clave = '',
        public float $importe_gravado = 0.0,
        public float $importe_exento = 0.0,
        public ?\Facturapi\Models\NominaAccionesInput $acciones_o_titulos = null,

        /** @var \Facturapi\Models\NominaHorasExtraInput[]|null */
        public ?array $horas_extra = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['tipo_percepcion'] ?? '',
            $data['concepto'] ?? null,
            $data['clave'] ?? '',
            $data['importe_gravado'] ?? 0,
            $data['importe_exento'] ?? 0,
            isset($data['acciones_o_titulos']) && is_array($data['acciones_o_titulos']) ? \Facturapi\Models\NominaAccionesInput::fromArray($data['acciones_o_titulos']) : null,
            isset($data['horas_extra']) && is_array($data['horas_extra']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NominaHorasExtraInput::fromArray($i) : $i, $data['horas_extra']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'tipo_percepcion' => $this->tipo_percepcion,
            'concepto' => $this->concepto,
            'clave' => $this->clave,
            'importe_gravado' => $this->importe_gravado,
            'importe_exento' => $this->importe_exento,
            'acciones_o_titulos' => $this->acciones_o_titulos?->toArray(),
            'horas_extra' => $this->horas_extra !== null ? array_map(fn (\Facturapi\Models\NominaHorasExtraInput $i): array => $i->toArray(), $this->horas_extra) : null
        ], fn (string|float|array|null $v): bool => $v !== null);
    }
}
