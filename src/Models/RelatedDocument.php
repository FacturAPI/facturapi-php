<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class RelatedDocument
{
    public function __construct(
        public ?string $relationship = null,
        public ?array $documents = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['relationship'] ?? null,
            $data['documents'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'relationship' => $this->relationship,
            'documents' => $this->documents
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
