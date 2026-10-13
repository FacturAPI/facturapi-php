<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ProductCatalogResult
{
    public function __construct(
        public ?string $key = null,
        public ?string $description = null,
        public ?float $score = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['description'] ?? null,
            $data['score'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'key' => $this->key,
            'description' => $this->description,
            'score' => $this->score
        ], fn (string|float|null $v): bool => $v !== null);
    }
}
