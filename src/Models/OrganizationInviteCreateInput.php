<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationInviteCreateInput
{
    public function __construct(
        public string $email,
        public ?string $role = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['email'] ?? '',
            $data['role'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'email' => $this->email,
            'role' => $this->role
        ], fn (?string $v): bool => $v !== null);
    }
}
