<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationDeleteCerts
{
    public function __construct(
        public ?string $updated_at = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['updated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'updated_at' => $this->updated_at
        ], fn (?string $v): bool => $v !== null);
    }
}
