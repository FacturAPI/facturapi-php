<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class LineItem
{
    public function __construct(
        public ?float $quantity = null,
        public ?float $discount = null,
        public ?\Facturapi\Models\LineItemProduct $product = null,
        public ?\Facturapi\Models\Parts $parts = null,
        public ?array $customs_keys = null,
        public mixed $complement = null,
        public mixed $third_party = null,
        public ?array $property_tax_account = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['quantity']) ? (float) $data['quantity'] : 0.0,
            isset($data['discount']) ? (float) $data['discount'] : 0.0,
            isset($data['product']) && is_array($data['product']) ? \Facturapi\Models\LineItemProduct::fromArray($data['product']) : null,
            isset($data['parts']) && is_array($data['parts']) ? \Facturapi\Models\Parts::fromArray($data['parts']) : null,
            $data['customs_keys'] ?? null,
            $data['complement'] ?? null,
            $data['third_party'] ?? null,
            $data['property_tax_account'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'quantity' => $this->quantity,
            'discount' => $this->discount,
            'product' => $this->product?->toArray(),
            'parts' => $this->parts?->toArray(),
            'customs_keys' => $this->customs_keys,
            'complement' => $this->complement,
            'third_party' => $this->third_party,
            'property_tax_account' => $this->property_tax_account,
        ], fn ($v): bool => $v !== null);
    }
}
