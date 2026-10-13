<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ReceiptInput
{
    public function __construct(
        public mixed $customer = null,
        public mixed $address = null,

        /** @var \Facturapi\Models\LineItemInput[]|null */
        public array $items = [],
        public ?string $date = null,
        public string $payment_form = '',
        public ?int $folio_number = null,
        public ?string $currency = null,
        public ?float $exchange = null,
        public ?string $branch = null,
        public ?string $external_id = null,
        public ?string $idempotency_key = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['customer'] ?? null,
            $data['address'] ?? null,
            isset($data['items']) && is_array($data['items']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\LineItemInput::fromArray($i) : $i, $data['items']) : [],
            $data['date'] ?? null,
            $data['payment_form'] ?? '',
            $data['folio_number'] ?? 0,
            $data['currency'] ?? null,
            $data['exchange'] ?? 0,
            $data['branch'] ?? null,
            $data['external_id'] ?? null,
            $data['idempotency_key'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'customer' => $this->customer,
            'address' => $this->address,
            'items' => $this->items !== null ? array_map(fn (\Facturapi\Models\LineItemInput $i): array => $i->toArray(), $this->items) : null,
            'date' => $this->date,
            'payment_form' => $this->payment_form,
            'folio_number' => $this->folio_number,
            'currency' => $this->currency,
            'exchange' => $this->exchange,
            'branch' => $this->branch,
            'external_id' => $this->external_id,
            'idempotency_key' => $this->idempotency_key
        ], fn ($v): bool => $v !== null);
    }
}
