<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class WebhookProperties
{
    public function __construct(
        public ?string $organization = null,
        public ?bool $livemode = null,
        public ?array $enabled_events = null,
        public ?string $url = null,
        public ?string $status = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['organization'] ?? null,
            $data['livemode'] ?? false,
            $data['enabled_events'] ?? null,
            $data['url'] ?? null,
            $data['status'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'organization' => $this->organization,
            'livemode' => $this->livemode,
            'enabled_events' => $this->enabled_events,
            'url' => $this->url,
            'status' => $this->status
        ], fn ($v): bool => $v !== null);
    }
}
