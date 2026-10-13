<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class InvoiceNominaEditInput
{
    public function __construct(
        public ?string $type = null,

        /** @var \Facturapi\Models\NominaOrCustomComplementInput[]|null */
        public ?array $complements = null,

        /** @var \Facturapi\Models\RelatedDocumentInput[]|null */
        public ?array $related_documents = null,
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
            isset($data['complements']) && is_array($data['complements']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NominaOrCustomComplementInput::fromArray($i) : $i, $data['complements']) : [],
            isset($data['related_documents']) && is_array($data['related_documents']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\RelatedDocumentInput::fromArray($i) : $i, $data['related_documents']) : [],
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
            'complements' => $this->complements !== null ? array_map(fn (\Facturapi\Models\NominaOrCustomComplementInput $i): array => $i->toArray(), $this->complements) : null,
            'related_documents' => $this->related_documents !== null ? array_map(fn (\Facturapi\Models\RelatedDocumentInput $i): array => $i->toArray(), $this->related_documents) : null,
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
