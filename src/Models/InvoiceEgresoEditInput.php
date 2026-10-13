<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class InvoiceEgresoEditInput
{
    public function __construct(
        public ?string $type = null,
        public ?string $payment_form = null,
        public ?string $payment_method = null,

        /** @var \Facturapi\Models\RelatedDocumentInput[]|null */
        public ?array $related_documents = null,

        /** @var \Facturapi\Models\LineItemEgresoInput[]|null */
        public ?array $items = null,
        public ?string $use = null,
        public ?string $currency = null,
        public ?float $exchange = null,

        /** @var \Facturapi\Models\CustomComplementInput[]|null */
        public ?array $complements = null,
        public mixed $customer = null,
        public ?string $status = null,
        public ?string $date = null,
        public mixed $address = null,
        public ?string $external_id = null,
        public ?string $idempotency_key = null,
        public ?int $folio_number = null,
        public ?string $series = null,
        public ?string $pdf_custom_section = null,
        public ?string $addenda = null,
        public ?array $namespaces = null,
        public ?array $pdf_options = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'] ?? null,
            $data['payment_form'] ?? null,
            $data['payment_method'] ?? null,
            isset($data['related_documents']) && is_array($data['related_documents']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\RelatedDocumentInput::fromArray($i) : $i, $data['related_documents']) : [],
            isset($data['items']) && is_array($data['items']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\LineItemEgresoInput::fromArray($i) : $i, $data['items']) : [],
            $data['use'] ?? null,
            $data['currency'] ?? null,
            $data['exchange'] ?? 0,
            isset($data['complements']) && is_array($data['complements']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CustomComplementInput::fromArray($i) : $i, $data['complements']) : [],
            $data['customer'] ?? null,
            $data['status'] ?? null,
            $data['date'] ?? null,
            $data['address'] ?? null,
            $data['external_id'] ?? null,
            $data['idempotency_key'] ?? null,
            $data['folio_number'] ?? 0,
            $data['series'] ?? null,
            $data['pdf_custom_section'] ?? null,
            $data['addenda'] ?? null,
            $data['namespaces'] ?? [],
            $data['pdf_options'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'payment_form' => $this->payment_form,
            'payment_method' => $this->payment_method,
            'related_documents' => $this->related_documents !== null ? array_map(fn (\Facturapi\Models\RelatedDocumentInput $i): array => $i->toArray(), $this->related_documents) : null,
            'items' => $this->items !== null ? array_map(fn (\Facturapi\Models\LineItemEgresoInput $i): array => $i->toArray(), $this->items) : null,
            'use' => $this->use,
            'currency' => $this->currency,
            'exchange' => $this->exchange,
            'complements' => $this->complements !== null ? array_map(fn (\Facturapi\Models\CustomComplementInput $i): array => $i->toArray(), $this->complements) : null,
            'customer' => $this->customer,
            'status' => $this->status,
            'date' => $this->date,
            'address' => $this->address,
            'external_id' => $this->external_id,
            'idempotency_key' => $this->idempotency_key,
            'folio_number' => $this->folio_number,
            'series' => $this->series,
            'pdf_custom_section' => $this->pdf_custom_section,
            'addenda' => $this->addenda,
            'namespaces' => $this->namespaces,
            'pdf_options' => $this->pdf_options
        ], fn ($v): bool => $v !== null);
    }
}
