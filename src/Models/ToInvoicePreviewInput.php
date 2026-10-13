<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ToInvoicePreviewInput
{
    public function __construct(
        public array $keys,
        public mixed $customer = null,
        public ?string $use = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['keys'] ?? [],
            $data['customer'] ?? null,
            $data['use'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'keys' => $this->keys,
            'customer' => $this->customer,
            'use' => $this->use
        ], fn ($v): bool => $v !== null);
    }
}
