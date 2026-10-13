<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ComercioExteriorEmisor
{
    public function __construct(
        public \Facturapi\Models\ComercioExteriorDomicilio $Domicilio,
        public ?string $Curp = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['Domicilio']) && is_array($data['Domicilio']) ? \Facturapi\Models\ComercioExteriorDomicilio::fromArray($data['Domicilio']) : null,
            $data['Curp'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'Domicilio' => $this->Domicilio?->toArray(),
            'Curp' => $this->Curp
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
