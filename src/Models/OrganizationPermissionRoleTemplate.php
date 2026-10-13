<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationPermissionRoleTemplate
{
    public function __construct(
        public ?string $code = null,
        public ?string $label = null,
        public ?array $operations = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['code'] ?? null,
            $data['label'] ?? null,
            $data['operations'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'code' => $this->code,
            'label' => $this->label,
            'operations' => $this->operations
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
