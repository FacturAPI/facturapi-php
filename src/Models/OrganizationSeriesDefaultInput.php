<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationSeriesDefaultInput
{
    public function __construct(
        public string $type,
        public string $series,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'] ?? '',
            $data['series'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'series' => $this->series
        ], fn (string $v): true => $v !== null);
    }
}
