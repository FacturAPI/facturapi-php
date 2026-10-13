<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationPermissionRoleCreateInput
{
    public function __construct(
        public string $name,
        public ?string $template_code = null,
        public ?array $add = null,
        public ?array $remove = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'] ?? '',
            $data['template_code'] ?? null,
            $data['add'] ?? [],
            $data['remove'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'template_code' => $this->template_code,
            'add' => $this->add,
            'remove' => $this->remove
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
