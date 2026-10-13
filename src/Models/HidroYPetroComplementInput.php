<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class HidroYPetroComplementInput
{
    public function __construct(
        public string $tipo_permiso,
        public string $numero_permiso,
        public string $sub_producto_hyp,
        public ?string $clave_hyp = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['tipo_permiso'] ?? '',
            $data['numero_permiso'] ?? '',
            $data['sub_producto_hyp'] ?? '',
            $data['clave_hyp'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'tipo_permiso' => $this->tipo_permiso,
            'numero_permiso' => $this->numero_permiso,
            'sub_producto_hyp' => $this->sub_producto_hyp,
            'clave_hyp' => $this->clave_hyp
        ], fn (?string $v): bool => $v !== null);
    }
}
