<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationLegalInput
{
    public function __construct(
        public string $name,
        public string $legal_name,
        public string $tax_system,
        public ?string $website = null,
        public ?string $support_email = null,
        public ?string $phone = null,
        public mixed $address = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'] ?? '',
            $data['legal_name'] ?? '',
            $data['tax_system'] ?? '',
            $data['website'] ?? null,
            $data['support_email'] ?? null,
            $data['phone'] ?? null,
            $data['address'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'legal_name' => $this->legal_name,
            'tax_system' => $this->tax_system,
            'website' => $this->website,
            'support_email' => $this->support_email,
            'phone' => $this->phone,
            'address' => $this->address
        ], fn ($v): bool => $v !== null);
    }
}
