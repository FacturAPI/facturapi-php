<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class DomainAvailability
{
    public function __construct(
        public bool $available = false,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['available'] ?? false
        );
    }

    public function toArray(): array
    {
        return [
            'available' => $this->available
        ];
    }
}
