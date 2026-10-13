<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class RelatedResourceMessage
{
    public function __construct(
        public ?string $resource_type = null,
        public ?string $resource_id = null,
        public ?string $source = null,
        public ?string $severity = null,
        public ?string $message = null,
        public ?string $created_at = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['resource_type'] ?? null,
            $data['resource_id'] ?? null,
            $data['source'] ?? null,
            $data['severity'] ?? null,
            $data['message'] ?? null,
            $data['created_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'resource_type' => $this->resource_type,
            'resource_id' => $this->resource_id,
            'source' => $this->source,
            'severity' => $this->severity,
            'message' => $this->message,
            'created_at' => $this->created_at
        ], fn (?string $v): bool => $v !== null);
    }
}
