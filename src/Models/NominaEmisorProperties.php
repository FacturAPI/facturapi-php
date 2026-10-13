<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaEmisorProperties
{
    public function __construct(
        public ?string $curp = null,
        public ?string $registro_patronal = null,
        public ?string $rfc_patron_origen = null,
        public ?array $entidad_sncf = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['curp'] ?? null,
            $data['registro_patronal'] ?? null,
            $data['rfc_patron_origen'] ?? null,
            $data['entidad_sncf'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'curp' => $this->curp,
            'registro_patronal' => $this->registro_patronal,
            'rfc_patron_origen' => $this->rfc_patron_origen,
            'entidad_sncf' => $this->entidad_sncf
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
