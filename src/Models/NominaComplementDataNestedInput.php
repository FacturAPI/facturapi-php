<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaComplementDataNestedInput
{
    public function __construct(
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
            'emisor' => $this->emisor?->toArray(),
            'receptor' => $this->receptor?->toArray(),
            'percepciones' => $this->percepciones?->toArray(),
            'deducciones' => $this->deducciones !== null ? array_map(fn (\Facturapi\Models\NominaDeduccionInput $i): array => $i->toArray(), $this->deducciones) : null,
            'otros_pagos' => $this->otros_pagos,
            'incapacidades' => $this->incapacidades !== null ? array_map(fn (\Facturapi\Models\NominaIncapacidadInput $i): array => $i->toArray(), $this->incapacidades) : null
        ], fn (?array $v): bool => $v !== null);
    }
}
