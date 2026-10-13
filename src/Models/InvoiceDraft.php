<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class InvoiceDraft
{
    public function __construct(
        public string $id,
        public string $created_at,
        public bool $livemode,
        public ?string $status = null,
        public ?string $cancellation_status = null,
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

        /** @var \Facturapi\Models\LineItem[]|null */
        public ?array $items = null,

        /** @var \Facturapi\Models\RelatedDocument[]|null */
        public ?array $related_documents = null,
        public ?string $currency = null,
        public ?float $exchange = null,

        /** @var \Facturapi\Models\NominaOrCustomComplementProperties[]|null */
        public ?array $complements = null,
        public ?string $pdf_custom_section = null,
        public ?string $addenda = null,

        /** @var \Facturapi\Models\NamespaceProperties[]|null */
        public ?array $namespaces = null,
        public ?bool $is_ready_to_stamp = null,
        public mixed $stamp = null,
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
            isset($data['items']) && is_array($data['items']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\LineItem::fromArray($i) : $i, $data['items']) : [],
            isset($data['related_documents']) && is_array($data['related_documents']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\RelatedDocument::fromArray($i) : $i, $data['related_documents']) : [],
            $data['currency'] ?? null,
            $data['exchange'] ?? 0,
            isset($data['complements']) && is_array($data['complements']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NominaOrCustomComplementProperties::fromArray($i) : $i, $data['complements']) : [],
            $data['pdf_custom_section'] ?? null,
            $data['addenda'] ?? null,
            isset($data['namespaces']) && is_array($data['namespaces']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NamespaceProperties::fromArray($i) : $i, $data['namespaces']) : [],
            $data['is_ready_to_stamp'] ?? false,
            $data['stamp'] ?? null
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
            'items' => $this->items !== null ? array_map(fn (\Facturapi\Models\LineItem $i): array => $i->toArray(), $this->items) : null,
            'related_documents' => $this->related_documents !== null ? array_map(fn (\Facturapi\Models\RelatedDocument $i): array => $i->toArray(), $this->related_documents) : null,
            'currency' => $this->currency,
            'exchange' => $this->exchange,
            'complements' => $this->complements !== null ? array_map(fn (\Facturapi\Models\NominaOrCustomComplementProperties $i): array => $i->toArray(), $this->complements) : null,
            'pdf_custom_section' => $this->pdf_custom_section,
            'addenda' => $this->addenda,
            'namespaces' => $this->namespaces !== null ? array_map(fn (\Facturapi\Models\NamespaceProperties $i): array => $i->toArray(), $this->namespaces) : null,
            'is_ready_to_stamp' => $this->is_ready_to_stamp,
            'stamp' => $this->stamp
        ], fn ($v): bool => $v !== null);
    }
}
