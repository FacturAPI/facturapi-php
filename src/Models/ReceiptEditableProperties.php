<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ReceiptEditableProperties
{
    public function __construct(
        public ?string $date = null,
        public ?string $payment_form = null,
        public ?int $folio_number = null,
        public ?string $currency = null,
        public ?float $exchange = null,
        public ?string $branch = null,
        public ?string $external_id = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['date'] ?? null,
            $data['payment_form'] ?? null,
            $data['folio_number'] ?? 0,
            $data['currency'] ?? null,
            $data['exchange'] ?? 0,
            $data['branch'] ?? null,
            $data['external_id'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'date' => $this->date,
            'payment_form' => $this->payment_form,
            'folio_number' => $this->folio_number,
            'currency' => $this->currency,
            'exchange' => $this->exchange,
            'branch' => $this->branch,
            'external_id' => $this->external_id
        ], fn (int|float|string|null $v): bool => $v !== null);
    }
}
