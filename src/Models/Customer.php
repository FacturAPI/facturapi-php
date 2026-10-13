<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class Customer
{
    public function __construct(
        public string $id,
        public string $created_at,
        public bool $livemode,
        public ?string $edit_link = null,
        public ?string $edit_link_expires_at = null,
        public ?string $sat_validated_at = null,
        public ?string $legal_name = null,
        public ?string $tax_id = null,
        public ?string $tax_system = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $default_invoice_use = null,
        public ?CommonAddressProperties $address = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $address = null;
        if (isset($data['address'])) {
            if ($data['address'] instanceof CommonAddressProperties) {
                $address = $data['address'];
            } elseif (is_array($data['address'])) {
                $address = CommonAddressProperties::fromArray($data['address']);
            }
        }

        return new self(
            $data['id'] ?? '',
            $data['created_at'] ?? '',
            $data['livemode'] ?? false,
            $data['edit_link'] ?? null,
            $data['edit_link_expires_at'] ?? null,
            $data['sat_validated_at'] ?? null,
            $data['legal_name'] ?? null,
            $data['tax_id'] ?? null,
            $data['tax_system'] ?? null,
            $data['email'] ?? null,
            $data['phone'] ?? null,
            $data['default_invoice_use'] ?? null,
            $address
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'livemode' => $this->livemode,
            'edit_link' => $this->edit_link,
            'edit_link_expires_at' => $this->edit_link_expires_at,
            'sat_validated_at' => $this->sat_validated_at,
            'legal_name' => $this->legal_name,
            'tax_id' => $this->tax_id,
            'tax_system' => $this->tax_system,
            'email' => $this->email,
            'phone' => $this->phone,
            'default_invoice_use' => $this->default_invoice_use,
            'address' => $this->address?->toArray(),
        ], fn ($v): bool => $v !== null);
    }
}
