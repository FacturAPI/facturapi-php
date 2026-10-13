<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class EventBase
{
    public function __construct(
        public ?string $id = null,
        public ?string $created_at = null,
        public ?bool $livemode = null,
        public ?string $organization = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['created_at'] ?? null,
            $data['livemode'] ?? false,
            $data['organization'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'livemode' => $this->livemode,
            'organization' => $this->organization
        ], fn (bool|string|null $v): bool => $v !== null);
    }
}
