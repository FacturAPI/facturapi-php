<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class WebhookCreateInput
{
    public function __construct(
        public string $url,
        public array $enabled_events,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['url'] ?? '',
            $data['enabled_events'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'url' => $this->url,
            'enabled_events' => $this->enabled_events
        ], fn (string|array $v): true => $v !== null);
    }
}
