<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CustomerProperties
{
    public function __construct(
        public ?string $legal_name = null,
        public ?string $tax_id = null,
        public ?string $tax_system = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $default_invoice_use = null,
        public mixed $address = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['legal_name'] ?? null,
            $data['tax_id'] ?? null,
            $data['tax_system'] ?? null,
            $data['email'] ?? null,
            $data['phone'] ?? null,
            $data['default_invoice_use'] ?? null,
            $data['address'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'legal_name' => $this->legal_name,
            'tax_id' => $this->tax_id,
            'tax_system' => $this->tax_system,
            'email' => $this->email,
            'phone' => $this->phone,
            'default_invoice_use' => $this->default_invoice_use,
            'address' => $this->address
        ], fn ($v): bool => $v !== null);
    }
}
