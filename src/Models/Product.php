<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class Product
{
    public function __construct(
        public string $id,
        public string $created_at,
        public bool $livemode,
        public string $description,
        public string $product_key,
        public float $price,
        public ?bool $tax_included = null,
        public ?string $taxability = null,

        /** @var \Facturapi\Models\BaseTax[]|null */
        public ?array $taxes = null,

        /** @var \Facturapi\Models\LocalTax[]|null */
        public ?array $local_taxes = null,
        public string $unit_key = '',
        public ?string $unit_name = null,
        public ?string $sku = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['id']) ? (string) $data['id'] : '',
            isset($data['created_at']) ? (string) $data['created_at'] : '',
            isset($data['livemode']) ? (bool) $data['livemode'] : false,
            isset($data['description']) ? (string) $data['description'] : '',
            isset($data['product_key']) ? (string) $data['product_key'] : '',
            (float) ($data['price'] ?? 0.0),
            isset($data['tax_included']) ? (bool) $data['tax_included'] : null,
            isset($data['taxability']) ? (string) $data['taxability'] : null,
            isset($data['taxes']) && is_array($data['taxes'])
                ? array_map(fn (mixed $i): \Facturapi\Models\BaseTax => $i instanceof \Facturapi\Models\BaseTax ? $i : \Facturapi\Models\BaseTax::fromArray((array) $i), $data['taxes'])
                : null,
            isset($data['local_taxes']) && is_array($data['local_taxes'])
                ? array_map(fn (mixed $i): \Facturapi\Models\LocalTax => $i instanceof \Facturapi\Models\LocalTax ? $i : \Facturapi\Models\LocalTax::fromArray((array) $i), $data['local_taxes'])
                : null,
            isset($data['unit_key']) ? (string) $data['unit_key'] : '',
            isset($data['unit_name']) ? (string) $data['unit_name'] : null,
            isset($data['sku']) ? (string) $data['sku'] : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'livemode' => $this->livemode,
            'description' => $this->description,
            'product_key' => $this->product_key,
            'price' => $this->price,
            'tax_included' => $this->tax_included,
            'taxability' => $this->taxability,
            'taxes' => $this->taxes !== null ? array_map(fn (\Facturapi\Models\BaseTax $i): array => $i->toArray(), $this->taxes) : null,
            'local_taxes' => $this->local_taxes !== null ? array_map(fn (\Facturapi\Models\LocalTax $i): array => $i->toArray(), $this->local_taxes) : null,
            'unit_key' => $this->unit_key,
            'unit_name' => $this->unit_name,
            'sku' => $this->sku,
        ], fn (int|float|bool|string|array|null $v): bool => $v !== null);
    }
}
