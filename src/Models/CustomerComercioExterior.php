<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CustomerComercioExterior
{
    public function __construct(
        public ?string $id = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id
        ], fn (?string $v): bool => $v !== null);
    }
}
