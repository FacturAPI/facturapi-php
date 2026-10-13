<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationUserAccessRoleUpdateInput
{
    public function __construct(
        public string $role,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['role'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'role' => $this->role
        ], fn (string $v): true => $v !== null);
    }
}
