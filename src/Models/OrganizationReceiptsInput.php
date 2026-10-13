<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationReceiptsInput
{
    public function __construct(
        public ?string $periodicity = null,
        public ?int $duration_days = null,
        public ?int $next_folio_number = null,
        public ?int $next_folio_number_test = null,
        public ?bool $activate_global_invoice = null,
        public ?bool $grouped_items_invoice = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['periodicity'] ?? null,
            $data['duration_days'] ?? 0,
            $data['next_folio_number'] ?? 0,
            $data['next_folio_number_test'] ?? 0,
            $data['activate_global_invoice'] ?? false,
            $data['grouped_items_invoice'] ?? false
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'periodicity' => $this->periodicity,
            'duration_days' => $this->duration_days,
            'next_folio_number' => $this->next_folio_number,
            'next_folio_number_test' => $this->next_folio_number_test,
            'activate_global_invoice' => $this->activate_global_invoice,
            'grouped_items_invoice' => $this->grouped_items_invoice
        ], fn (string|int|bool|null $v): bool => $v !== null);
    }
}
