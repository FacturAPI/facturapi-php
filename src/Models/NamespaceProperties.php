<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NamespaceProperties
{
    public function __construct(
        public ?string $prefix = null,
        public ?string $uri = null,
        public ?string $schema_location = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['prefix'] ?? null,
            $data['uri'] ?? null,
            $data['schema_location'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'prefix' => $this->prefix,
            'uri' => $this->uri,
            'schema_location' => $this->schema_location
        ], fn (?string $v): bool => $v !== null);
    }
}
