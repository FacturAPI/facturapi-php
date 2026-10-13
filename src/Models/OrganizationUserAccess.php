<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationUserAccess
{
    public function __construct(
        public ?string $id = null,
        public ?string $full_name = null,
        public ?string $email = null,
        public ?string $role = null,
        public ?string $role_name = null,
        public ?string $organization = null,
        public ?array $operations = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['full_name'] ?? null,
            $data['email'] ?? null,
            $data['role'] ?? null,
            $data['role_name'] ?? null,
            $data['organization'] ?? null,
            $data['operations'] ?? [],
            $data['created_at'] ?? null,
            $data['updated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'role' => $this->role,
            'role_name' => $this->role_name,
            'organization' => $this->organization,
            'operations' => $this->operations,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
