<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CustomerInfo
{
    public function __construct(
        public ?string $id = null,
        public ?string $legal_name = null,
        public ?string $tax_id = null,
        public ?array $address = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['legal_name'] ?? null,
            $data['tax_id'] ?? null,
            $data['address'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'legal_name' => $this->legal_name,
            'tax_id' => $this->tax_id,
            'address' => $this->address
        ], fn (string|array|null $v): bool => $v !== null);
    }
}
