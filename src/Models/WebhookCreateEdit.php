<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class WebhookCreateEdit
{
    public function __construct(
        public ?string $status = null,
        public array $enabled_events = [],
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['status'] ?? null,
            $data['enabled_events'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'status' => $this->status,
            'enabled_events' => $this->enabled_events
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
