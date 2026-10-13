<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaComplementDataInput
{
    public function __construct(
        public ?string $tipo_nomina = null,
        public ?string $fecha_pago = null,
        public string $fecha_inicial_pago = '',
        public string $fecha_final_pago = '',
        public float $num_dias_pagados = 0.0,
        public ?\Facturapi\Models\NominaEmisorProperties $emisor = null,
        public ?\Facturapi\Models\NominaReceptorInput $receptor = null,
        public ?\Facturapi\Models\NominaPercepcionesInput $percepciones = null,

        /** @var \Facturapi\Models\NominaDeduccionInput[]|null */
        public ?array $deducciones = null,
        public ?array $otros_pagos = null,

        /** @var \Facturapi\Models\NominaIncapacidadInput[]|null */
        public ?array $incapacidades = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['tipo_nomina'] ?? null,
            $data['fecha_pago'] ?? null,
            $data['fecha_inicial_pago'] ?? '',
            $data['fecha_final_pago'] ?? '',
            $data['num_dias_pagados'] ?? 0,
            isset($data['emisor']) && is_array($data['emisor']) ? \Facturapi\Models\NominaEmisorProperties::fromArray($data['emisor']) : null,
            isset($data['receptor']) && is_array($data['receptor']) ? \Facturapi\Models\NominaReceptorInput::fromArray($data['receptor']) : null,
            isset($data['percepciones']) && is_array($data['percepciones']) ? \Facturapi\Models\NominaPercepcionesInput::fromArray($data['percepciones']) : null,
            isset($data['deducciones']) && is_array($data['deducciones']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NominaDeduccionInput::fromArray($i) : $i, $data['deducciones']) : [],
            $data['otros_pagos'] ?? [],
            isset($data['incapacidades']) && is_array($data['incapacidades']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NominaIncapacidadInput::fromArray($i) : $i, $data['incapacidades']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'tipo_nomina' => $this->tipo_nomina,
            'fecha_pago' => $this->fecha_pago,
            'fecha_inicial_pago' => $this->fecha_inicial_pago,
            'fecha_final_pago' => $this->fecha_final_pago,
            'num_dias_pagados' => $this->num_dias_pagados,
            'emisor' => $this->emisor?->toArray(),
            'receptor' => $this->receptor?->toArray(),
            'percepciones' => $this->percepciones?->toArray(),
            'deducciones' => $this->deducciones !== null ? array_map(fn (\Facturapi\Models\NominaDeduccionInput $i): array => $i->toArray(), $this->deducciones) : null,
            'otros_pagos' => $this->otros_pagos,
            'incapacidades' => $this->incapacidades !== null ? array_map(fn (\Facturapi\Models\NominaIncapacidadInput $i): array => $i->toArray(), $this->incapacidades) : null
        ], fn (string|float|array|null $v): bool => $v !== null);
    }
}
