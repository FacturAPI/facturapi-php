<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class DateRange
{
    public function __construct(
        public ?string $gt = null,
        public ?string $gte = null,
        public ?string $lt = null,
        public ?string $lte = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['gt'] ?? null,
            $data['gte'] ?? null,
            $data['lt'] ?? null,
            $data['lte'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'gt' => $this->gt,
            'gte' => $this->gte,
            'lt' => $this->lt,
            'lte' => $this->lte
        ], fn (?string $v): bool => $v !== null);
    }
}
