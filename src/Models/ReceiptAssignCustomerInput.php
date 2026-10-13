<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ReceiptAssignCustomerInput
{
    public function __construct(
        public mixed $customer,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['customer'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'customer' => $this->customer
        ], fn ($v): bool => $v !== null);
    }
}
