<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class Invoice
{
    public function __construct(
        public string $id,
        public string $created_at,
        public bool $livemode,
        public ?string $status = null,
        public ?string $cancellation_status = null,
        public ?string $canceled_at = null,
        public ?string $verification_url = null,
        public ?string $date = null,
        public mixed $address = null,
        public ?string $type = null,
        public ?\Facturapi\Models\CustomerInfo $customer = null,
        public ?float $total = null,
        public ?string $uuid = null,
        public ?int $folio_number = null,
        public ?string $series = null,
        public ?string $external_id = null,
        public ?string $idempotency_key = null,
        public ?string $payment_form = null,
        public ?string $payment_method = null,
        public ?string $use = null,
        public ?string $conditions = null,
        public ?float $total_payment_amount = null,
        public ?float $total_payment_amount_converted = null,
        public ?bool $is_ready_to_stamp = null,

        /** @var \Facturapi\Models\LineItem[]|null */
        public ?array $items = null,

        /** @var \Facturapi\Models\RelatedDocument[]|null */
        public ?array $related_documents = null,
        public ?array $received_payment_ids = null,
        public ?array $target_invoice_ids = null,
        public ?string $currency = null,
        public ?float $exchange = null,

        /** @var \Facturapi\Models\NominaOrCustomComplementProperties[]|null */
        public ?array $complements = null,
        public ?string $pdf_custom_section = null,
        public ?string $addenda = null,

        /** @var \Facturapi\Models\NamespaceProperties[]|null */
        public ?array $namespaces = null,
        public ?\Facturapi\Models\Stamp $stamp = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? '',
            $data['created_at'] ?? '',
            $data['livemode'] ?? false,
            $data['status'] ?? null,
            $data['cancellation_status'] ?? null,
            $data['canceled_at'] ?? null,
            $data['verification_url'] ?? null,
            $data['date'] ?? null,
            $data['address'] ?? null,
            $data['type'] ?? null,
            isset($data['customer']) && is_array($data['customer']) ? \Facturapi\Models\CustomerInfo::fromArray($data['customer']) : null,
            $data['total'] ?? 0,
            $data['uuid'] ?? null,
            $data['folio_number'] ?? 0,
            $data['series'] ?? null,
            $data['external_id'] ?? null,
            $data['idempotency_key'] ?? null,
            $data['payment_form'] ?? null,
            $data['payment_method'] ?? null,
            $data['use'] ?? null,
            $data['conditions'] ?? null,
            $data['total_payment_amount'] ?? 0,
            $data['total_payment_amount_converted'] ?? 0,
            $data['is_ready_to_stamp'] ?? false,
            isset($data['items']) && is_array($data['items']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\LineItem::fromArray($i) : $i, $data['items']) : [],
            isset($data['related_documents']) && is_array($data['related_documents']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\RelatedDocument::fromArray($i) : $i, $data['related_documents']) : [],
            $data['received_payment_ids'] ?? [],
            $data['target_invoice_ids'] ?? [],
            $data['currency'] ?? null,
            $data['exchange'] ?? 0,
            isset($data['complements']) && is_array($data['complements']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NominaOrCustomComplementProperties::fromArray($i) : $i, $data['complements']) : [],
            $data['pdf_custom_section'] ?? null,
            $data['addenda'] ?? null,
            isset($data['namespaces']) && is_array($data['namespaces']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NamespaceProperties::fromArray($i) : $i, $data['namespaces']) : [],
            isset($data['stamp']) && is_array($data['stamp']) ? \Facturapi\Models\Stamp::fromArray($data['stamp']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'livemode' => $this->livemode,
            'status' => $this->status,
            'cancellation_status' => $this->cancellation_status,
            'canceled_at' => $this->canceled_at,
            'verification_url' => $this->verification_url,
            'date' => $this->date,
            'address' => $this->address,
            'type' => $this->type,
            'customer' => $this->customer?->toArray(),
            'total' => $this->total,
            'uuid' => $this->uuid,
            'folio_number' => $this->folio_number,
            'series' => $this->series,
            'external_id' => $this->external_id,
            'idempotency_key' => $this->idempotency_key,
            'payment_form' => $this->payment_form,
            'payment_method' => $this->payment_method,
            'use' => $this->use,
            'conditions' => $this->conditions,
            'total_payment_amount' => $this->total_payment_amount,
            'total_payment_amount_converted' => $this->total_payment_amount_converted,
            'is_ready_to_stamp' => $this->is_ready_to_stamp,
            'items' => $this->items !== null ? array_map(fn (\Facturapi\Models\LineItem $i): array => $i->toArray(), $this->items) : null,
            'related_documents' => $this->related_documents !== null ? array_map(fn (\Facturapi\Models\RelatedDocument $i): array => $i->toArray(), $this->related_documents) : null,
            'received_payment_ids' => $this->received_payment_ids,
            'target_invoice_ids' => $this->target_invoice_ids,
            'currency' => $this->currency,
            'exchange' => $this->exchange,
            'complements' => $this->complements !== null ? array_map(fn (\Facturapi\Models\NominaOrCustomComplementProperties $i): array => $i->toArray(), $this->complements) : null,
            'pdf_custom_section' => $this->pdf_custom_section,
            'addenda' => $this->addenda,
            'namespaces' => $this->namespaces !== null ? array_map(fn (\Facturapi\Models\NamespaceProperties $i): array => $i->toArray(), $this->namespaces) : null,
            'stamp' => $this->stamp?->toArray()
        ], fn ($v): bool => $v !== null);
    }
}
