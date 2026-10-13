<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationCustomizationInput
{
    public function __construct(
        public ?string $color = null,
        public ?int $next_folio_number = null,
        public ?int $next_folio_number_test = null,
        public ?array $pdf_extra = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['color'] ?? null,
            $data['next_folio_number'] ?? 0,
            $data['next_folio_number_test'] ?? 0,
            $data['pdf_extra'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'color' => $this->color,
            'next_folio_number' => $this->next_folio_number,
            'next_folio_number_test' => $this->next_folio_number_test,
            'pdf_extra' => $this->pdf_extra
        ], fn (string|int|array|null $v): bool => $v !== null);
    }
}
