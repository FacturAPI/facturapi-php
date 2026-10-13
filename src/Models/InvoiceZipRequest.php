<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class InvoiceZipRequest
{
    public function __construct(
        public string $id,
        public string $created_at,
        public bool $livemode,
        public string $organization = '',
        public ?\Facturapi\Enums\IssuingType $issuer_type = null,

        /** @var \Facturapi\Enums\InvoiceZipRequestInvoiceType[]|null */
        public ?array $invoice_types = null,
        public ?string $start_date = null,
        public ?string $end_date = null,
        public ?\Facturapi\Enums\InvoiceZipRequestStatus $status = null,
        public ?int $document_count = null,
        public ?int $processed_document = null,
        public ?array $failed_documents = null,
        public ?string $scheduled_at = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? '',
            $data['created_at'] ?? '',
            $data['livemode'] ?? false,
            $data['organization'] ?? '',
            isset($data['issuer_type']) && is_string($data['issuer_type']) ? \Facturapi\Enums\IssuingType::tryFrom($data['issuer_type']) : null,
            isset($data['invoice_types']) && is_array($data['invoice_types'])
                ? array_map(fn ($i) => is_string($i) ? (\Facturapi\Enums\InvoiceZipRequestInvoiceType::tryFrom($i) ?? $i) : $i, $data['invoice_types'])
                : [],
            $data['start_date'] ?? '',
            $data['end_date'] ?? '',
            isset($data['status']) && is_string($data['status']) ? \Facturapi\Enums\InvoiceZipRequestStatus::tryFrom($data['status']) : null,
            $data['document_count'] ?? 0,
            $data['processed_document'] ?? 0,
            $data['failed_documents'] ?? [],
            $data['scheduled_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'livemode' => $this->livemode,
            'organization' => $this->organization,
            'issuer_type' => $this->issuer_type?->value,
            'invoice_types' => $this->invoice_types !== null
                ? array_map(fn ($i) => $i instanceof \Facturapi\Enums\InvoiceZipRequestInvoiceType ? $i->value : $i, $this->invoice_types)
                : null,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status?->value,
            'document_count' => $this->document_count,
            'processed_document' => $this->processed_document,
            'failed_documents' => $this->failed_documents,
            'scheduled_at' => $this->scheduled_at
        ], fn ($v): bool => $v !== null);
    }
}
