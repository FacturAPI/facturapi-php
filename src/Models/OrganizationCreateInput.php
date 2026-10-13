<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationCreateInput
{
    public function __construct(
        public string $name,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name
        ], fn (string $v): true => $v !== null);
    }
}
