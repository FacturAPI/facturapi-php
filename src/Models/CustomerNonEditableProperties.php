<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CustomerNonEditableProperties
{
    public function __construct(
        public ?string $edit_link = null,
        public ?string $edit_link_expires_at = null,
        public ?string $sat_validated_at = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['edit_link'] ?? null,
            $data['edit_link_expires_at'] ?? null,
            $data['sat_validated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'edit_link' => $this->edit_link,
            'edit_link_expires_at' => $this->edit_link_expires_at,
            'sat_validated_at' => $this->sat_validated_at
        ], fn (?string $v): bool => $v !== null);
    }
}
