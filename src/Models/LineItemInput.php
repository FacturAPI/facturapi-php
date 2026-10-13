<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class LineItemInput
{
    public function __construct(
        public ?float $quantity = null,
        public ?float $discount = null,
        public mixed $product = null,

        /** @var \Facturapi\Models\PartInput[]|null */
        public ?array $parts = null,
        public ?array $customs_keys = null,
        public mixed $complement = null,
        public mixed $third_party = null,
        public ?array $property_tax_account = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['quantity'] ?? 0,
            $data['discount'] ?? 0,
            $data['product'] ?? '',
            isset($data['parts']) && is_array($data['parts']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\PartInput::fromArray($i) : $i, $data['parts']) : [],
            $data['customs_keys'] ?? [],
            $data['complement'] ?? null,
            $data['third_party'] ?? null,
            $data['property_tax_account'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'quantity' => $this->quantity,
            'discount' => $this->discount,
            'product' => $this->product,
            'parts' => $this->parts !== null ? array_map(fn (\Facturapi\Models\PartInput $i): array => $i->toArray(), $this->parts) : null,
            'customs_keys' => $this->customs_keys,
            'complement' => $this->complement,
            'third_party' => $this->third_party,
            'property_tax_account' => $this->property_tax_account
        ], fn ($v): bool => $v !== null);
    }
}
