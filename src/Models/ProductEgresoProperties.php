<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ProductEgresoProperties
{
    public function __construct(
        public string $description,
        public ?string $product_key = null,
        public float $price = 0.0,
        public ?bool $tax_included = null,
        public ?string $taxability = null,

        /** @var \Facturapi\Models\BaseTax[]|null */
        public ?array $taxes = null,

        /** @var \Facturapi\Models\LocalTax[]|null */
        public ?array $local_taxes = null,
        public ?string $unit_key = null,
        public ?string $unit_name = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['description'] ?? '',
            $data['product_key'] ?? null,
            $data['price'] ?? 0,
            $data['tax_included'] ?? false,
            $data['taxability'] ?? null,
            isset($data['taxes']) && is_array($data['taxes']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\BaseTax::fromArray($i) : $i, $data['taxes']) : [],
            isset($data['local_taxes']) && is_array($data['local_taxes']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\LocalTax::fromArray($i) : $i, $data['local_taxes']) : [],
            $data['unit_key'] ?? null,
            $data['unit_name'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'description' => $this->description,
            'product_key' => $this->product_key,
            'price' => $this->price,
            'tax_included' => $this->tax_included,
            'taxability' => $this->taxability,
            'taxes' => $this->taxes !== null ? array_map(fn (\Facturapi\Models\BaseTax $i): array => $i->toArray(), $this->taxes) : null,
            'local_taxes' => $this->local_taxes !== null ? array_map(fn (\Facturapi\Models\LocalTax $i): array => $i->toArray(), $this->local_taxes) : null,
            'unit_key' => $this->unit_key,
            'unit_name' => $this->unit_name
        ], fn (float|bool|string|array|null $v): bool => $v !== null);
    }
}
