<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CartaPorteProperties
{
    public function __construct(
        public ?string $type = null,
        public ?\Facturapi\Models\CartaPorteDataProperties $data = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'] ?? null,
            isset($data['data']) && is_array($data['data']) ? \Facturapi\Models\CartaPorteDataProperties::fromArray($data['data']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'data' => $this->data?->toArray()
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
