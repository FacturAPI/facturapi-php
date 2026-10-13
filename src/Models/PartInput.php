<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class PartInput
{
    public function __construct(
        public string $description,
        public string $product_key,
        public ?float $quantity = null,
        public ?string $sku = null,
        public ?float $unit_price = null,
        public ?string $unit_name = null,
        public ?array $customs_keys = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['description'] ?? '',
            $data['product_key'] ?? '',
            $data['quantity'] ?? 0,
            $data['sku'] ?? null,
            $data['unit_price'] ?? 0,
            $data['unit_name'] ?? null,
            $data['customs_keys'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'description' => $this->description,
            'product_key' => $this->product_key,
            'quantity' => $this->quantity,
            'sku' => $this->sku,
            'unit_price' => $this->unit_price,
            'unit_name' => $this->unit_name,
            'customs_keys' => $this->customs_keys
        ], fn (float|string|array|null $v): bool => $v !== null);
    }
}
