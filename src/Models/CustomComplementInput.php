<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CustomComplementInput
{
    public function __construct(
        public string $type,
        public \Facturapi\Models\CustomComplementData $data,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'] ?? '',
            isset($data['data']) && is_array($data['data']) ? \Facturapi\Models\CustomComplementData::fromArray($data['data']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'data' => $this->data?->toArray()
        ], fn ($v): bool => $v !== null);
    }
}
