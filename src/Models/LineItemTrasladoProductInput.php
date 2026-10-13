<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class LineItemTrasladoProductInput
{
    public function __construct(
        public string $description,
        public ?string $product_key = null,
        public ?string $unit_key = null,
        public ?string $unit_name = null,
        public ?string $sku = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['description'] ?? '',
            $data['product_key'] ?? null,
            $data['unit_key'] ?? null,
            $data['unit_name'] ?? null,
            $data['sku'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'description' => $this->description,
            'product_key' => $this->product_key,
            'unit_key' => $this->unit_key,
            'unit_name' => $this->unit_name,
            'sku' => $this->sku
        ], fn (?string $v): bool => $v !== null);
    }
}
