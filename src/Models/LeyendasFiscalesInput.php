<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class LeyendasFiscalesInput
{
    public function __construct(
        public string $type,
        public \Facturapi\Models\LeyendasFiscalesData $data,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'] ?? '',
            isset($data['data']) && is_array($data['data']) ? \Facturapi\Models\LeyendasFiscalesData::fromArray($data['data']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'data' => $this->data?->toArray()
        ], fn (string|array $v): true => $v !== null);
    }
}
