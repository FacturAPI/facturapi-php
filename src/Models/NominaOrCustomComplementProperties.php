<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaOrCustomComplementProperties
{
    public function __construct(
        public ?string $type = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type
        ], fn (?string $v): bool => $v !== null);
    }
}
