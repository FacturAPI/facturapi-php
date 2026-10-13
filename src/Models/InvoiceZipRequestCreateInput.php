<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class InvoiceZipRequestCreateInput
{
    public function __construct(
        public int $year,
        public int $month,
        public mixed $issuer_type = null,

        /** @var \Facturapi\Models\InvoiceZipRequestInvoiceType[]|null */
        public ?array $invoice_types = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['year'] ?? 0,
            $data['month'] ?? 0,
            $data['issuer_type'] ?? null,
            isset($data['invoice_types']) && is_array($data['invoice_types']) ? array_map(fn ($i) => is_array($i) ? \Facturapi\Models\InvoiceZipRequestInvoiceType::fromArray($i) : $i, $data['invoice_types']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'year' => $this->year,
            'month' => $this->month,
            'issuer_type' => $this->issuer_type,
            'invoice_types' => $this->invoice_types !== null ? array_map(fn (\Facturapi\Models\InvoiceZipRequestInvoiceType $i) => $i->toArray(), $this->invoice_types) : null
        ], fn ($v): bool => $v !== null);
    }
}
