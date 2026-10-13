<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class CustomerCreateInput
{
    public function __construct(
        public string $legal_name,
        public string $tax_id,
        public string $tax_system,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $default_invoice_use = null,
        public mixed $address = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['legal_name'] ?? '',
            $data['tax_id'] ?? '',
            $data['tax_system'] ?? '',
            $data['email'] ?? null,
            $data['phone'] ?? null,
            $data['default_invoice_use'] ?? null,
            $data['address'] ?? ''
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
