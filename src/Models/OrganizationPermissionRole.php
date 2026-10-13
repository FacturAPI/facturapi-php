<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationPermissionRole
{
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $template_code = null,
        public ?string $organization = null,
        public ?int $used_by = null,
        public ?array $overrides_add = null,
        public ?array $overrides_remove = null,
        public ?array $operations = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['name'] ?? null,
            $data['template_code'] ?? null,
            $data['organization'] ?? null,
            $data['used_by'] ?? 0,
            $data['overrides_add'] ?? [],
            $data['overrides_remove'] ?? [],
            $data['operations'] ?? [],
            $data['created_at'] ?? null,
            $data['updated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'name' => $this->name,
            'template_code' => $this->template_code,
            'organization' => $this->organization,
            'used_by' => $this->used_by,
            'overrides_add' => $this->overrides_add,
            'overrides_remove' => $this->overrides_remove,
            'operations' => $this->operations,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ], fn (int|string|array|null $v): bool => $v !== null);
    }
}
