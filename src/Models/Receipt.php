<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class Receipt
{
    public function __construct(
        public string $id,
        public string $created_at,
        public bool $livemode,
        public ?string $date = null,
        public ?string $expires_at = null,
        public ?string $status = null,
        public ?string $self_invoice_url = null,
        public ?float $total = null,
        public ?string $invoice = null,
        public ?string $customer = null,
        public ?string $key = null,

        /** @var \Facturapi\Models\LineItem[]|null */
        public ?array $items = null,
        public ?string $external_id = null,
        public ?string $idempotency_key = null,
        public ?string $payment_form = null,
        public ?int $folio_number = null,
        public ?string $currency = null,
        public ?float $exchange = null,
        public ?string $branch = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? '',
            $data['created_at'] ?? '',
            $data['livemode'] ?? false,
            $data['date'] ?? null,
            $data['expires_at'] ?? null,
            $data['status'] ?? null,
            $data['self_invoice_url'] ?? null,
            $data['total'] ?? 0,
            $data['invoice'] ?? null,
            $data['customer'] ?? null,
            $data['key'] ?? null,
            isset($data['items']) && is_array($data['items']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\LineItem::fromArray($i) : $i, $data['items']) : [],
            $data['external_id'] ?? null,
            $data['idempotency_key'] ?? null,
            $data['payment_form'] ?? null,
            $data['folio_number'] ?? 0,
            $data['currency'] ?? null,
            $data['exchange'] ?? 0,
            $data['branch'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'livemode' => $this->livemode,
            'date' => $this->date,
            'expires_at' => $this->expires_at,
            'status' => $this->status,
            'self_invoice_url' => $this->self_invoice_url,
            'total' => $this->total,
            'invoice' => $this->invoice,
            'customer' => $this->customer,
            'key' => $this->key,
            'items' => $this->items !== null ? array_map(fn (\Facturapi\Models\LineItem $i): array => $i->toArray(), $this->items) : null,
            'external_id' => $this->external_id,
            'idempotency_key' => $this->idempotency_key,
            'payment_form' => $this->payment_form,
            'folio_number' => $this->folio_number,
            'currency' => $this->currency,
            'exchange' => $this->exchange,
            'branch' => $this->branch
        ], fn (string|bool|float|int|array|null $v): bool => $v !== null);
    }
}
