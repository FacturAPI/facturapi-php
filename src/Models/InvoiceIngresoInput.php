<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class InvoiceIngresoInput
{
    public function __construct(
        public ?string $type = null,

        /** @var \Facturapi\Models\LineItemInput[]|null */
        public array $items = [],
        public string $payment_form = '',
        public ?string $payment_method = null,
        public string $use = '',
        public ?string $currency = null,
        public ?float $exchange = null,
        public ?string $conditions = null,

        /** @var \Facturapi\Models\RelatedDocumentInput[]|null */
        public ?array $related_documents = null,
        public ?array $global = null,
        public ?string $export = null,

        /** @var \Facturapi\Models\CartaPorteOrCustomComplementInput[]|null */
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
            isset($data['items']) && is_array($data['items']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\LineItemInput::fromArray($i) : $i, $data['items']) : [],
            $data['payment_form'] ?? '',
            $data['payment_method'] ?? null,
            $data['use'] ?? '',
            $data['currency'] ?? null,
            $data['exchange'] ?? 0,
            $data['conditions'] ?? null,
            isset($data['related_documents']) && is_array($data['related_documents']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\RelatedDocumentInput::fromArray($i) : $i, $data['related_documents']) : [],
            $data['global'] ?? [],
            $data['export'] ?? null,
            isset($data['complements']) && is_array($data['complements']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\CartaPorteOrCustomComplementInput::fromArray($i) : $i, $data['complements']) : [],
            $data['customer'] ?? '',
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
            'items' => $this->items !== null ? array_map(fn (\Facturapi\Models\LineItemInput $i): array => $i->toArray(), $this->items) : null,
            'payment_form' => $this->payment_form,
            'payment_method' => $this->payment_method,
            'use' => $this->use,
            'currency' => $this->currency,
            'exchange' => $this->exchange,
            'conditions' => $this->conditions,
            'related_documents' => $this->related_documents !== null ? array_map(fn (\Facturapi\Models\RelatedDocumentInput $i): array => $i->toArray(), $this->related_documents) : null,
            'global' => $this->global,
            'export' => $this->export,
            'complements' => $this->complements !== null ? array_map(fn (\Facturapi\Models\CartaPorteOrCustomComplementInput $i): array => $i->toArray(), $this->complements) : null,
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
