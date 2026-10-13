<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class InvoiceReceiptInput
{
    public function __construct(
        public mixed $customer = null,
        public ?string $use = null,
        public ?string $conditions = null,
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
            $data['customer'] ?? null,
            $data['use'] ?? null,
            $data['conditions'] ?? null,
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
            'customer' => $this->customer,
            'use' => $this->use,
            'conditions' => $this->conditions,
            'folio_number' => $this->folio_number,
            'series' => $this->series,
            'pdf_custom_section' => $this->pdf_custom_section,
            'addenda' => $this->addenda,
            'namespaces' => $this->namespaces,
            'pdf_options' => $this->pdf_options
        ], fn ($v): bool => $v !== null);
    }
}
