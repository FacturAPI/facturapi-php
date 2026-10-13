<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationInvite
{
    public function __construct(
        public ?string $id = null,
        public ?string $created_at = null,
        public ?string $email = null,
        public ?string $organization_name = null,
        public ?string $role = null,
        public ?string $role_name = null,
        public ?array $roles = null,
        public ?string $expires_at = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['created_at'] ?? null,
            $data['email'] ?? null,
            $data['organization_name'] ?? null,
            $data['role'] ?? null,
            $data['role_name'] ?? null,
            $data['roles'] ?? [],
            $data['expires_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'email' => $this->email,
            'organization_name' => $this->organization_name,
            'role' => $this->role,
            'role_name' => $this->role_name,
            'roles' => $this->roles,
            'expires_at' => $this->expires_at
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
