<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ToInvoiceInput
{
    public function __construct(
        public array $keys,
        public mixed $customer = null,
        public ?string $use = null,
        public ?bool $dry_run = null,
        public ?string $payment_form = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['keys'] ?? [],
            $data['customer'] ?? null,
            $data['use'] ?? null,
            $data['dry_run'] ?? false,
            $data['payment_form'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'keys' => $this->keys,
            'customer' => $this->customer,
            'use' => $this->use,
            'dry_run' => $this->dry_run,
            'payment_form' => $this->payment_form
        ], fn ($v): bool => $v !== null);
    }
}
