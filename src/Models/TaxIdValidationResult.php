<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class TaxIdValidationResult
{
    /**
     * @param array<string, mixed>|null $efos
     * @param array<int, array<string, mixed>>|null $errors
     */
    public function __construct(
        public bool $is_valid,
        public ?array $efos = null,
        public ?array $errors = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['is_valid'] ?? false,
            $data['efos'] ?? null,
            $data['errors'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'is_valid' => $this->is_valid,
            'efos' => $this->efos,
            'errors' => $this->errors,
        ], fn ($v): bool => $v !== null);
    }
}
