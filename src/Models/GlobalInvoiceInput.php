<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class GlobalInvoiceInput
{
    public function __construct(
        public ?string $from = null,
        public ?string $to = null,
        public string $periodicity = '',
        public ?string $months = null,
        public ?int $folio_number = null,
        public ?string $series = null,
        public ?string $date = null,
        public ?string $payment_form = null,
        public ?array $receipts = null,
        public ?bool $limit_to_max_receipts = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['from'] ?? null,
            $data['to'] ?? null,
            $data['periodicity'] ?? '',
            $data['months'] ?? null,
            $data['folio_number'] ?? 0,
            $data['series'] ?? null,
            $data['date'] ?? null,
            $data['payment_form'] ?? null,
            $data['receipts'] ?? [],
            $data['limit_to_max_receipts'] ?? false
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'from' => $this->from,
            'to' => $this->to,
            'periodicity' => $this->periodicity,
            'months' => $this->months,
            'folio_number' => $this->folio_number,
            'series' => $this->series,
            'date' => $this->date,
            'payment_form' => $this->payment_form,
            'receipts' => $this->receipts,
            'limit_to_max_receipts' => $this->limit_to_max_receipts
        ], fn (int|string|bool|array|null $v): bool => $v !== null);
    }
}
