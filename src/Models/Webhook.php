<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class Webhook
{
    public function __construct(
        public string $id,
        public string $created_at,
        public bool $livemode,
        public ?string $organization = null,
        public ?array $enabled_events = null,
        public ?string $url = null,
        public ?string $status = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? '',
            $data['created_at'] ?? '',
            $data['livemode'] ?? false,
            $data['organization'] ?? null,
            $data['enabled_events'] ?? null,
            $data['url'] ?? null,
            $data['status'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'livemode' => $this->livemode,
            'organization' => $this->organization,
            'enabled_events' => $this->enabled_events,
            'url' => $this->url,
            'status' => $this->status
        ], fn ($v): bool => $v !== null);
    }
}
