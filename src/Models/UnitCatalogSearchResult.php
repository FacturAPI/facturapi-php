<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class UnitCatalogSearchResult
{
    public function __construct(
        public ?int $page = null,
        public ?int $total_pages = null,
        public ?int $total_results = null,
        public ?string $previous_cursor = null,
        public ?string $next_cursor = null,
        public ?bool $totals_are_capped = null,

        /** @var \Facturapi\Models\UnitCatalogResult[]|null */
        public ?array $data = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['page'] ?? 0,
            $data['total_pages'] ?? 0,
            $data['total_results'] ?? 0,
            $data['previous_cursor'] ?? null,
            $data['next_cursor'] ?? null,
            $data['totals_are_capped'] ?? false,
            isset($data['data']) && is_array($data['data']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\UnitCatalogResult::fromArray($i) : $i, $data['data']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'page' => $this->page,
            'total_pages' => $this->total_pages,
            'total_results' => $this->total_results,
            'previous_cursor' => $this->previous_cursor,
            'next_cursor' => $this->next_cursor,
            'totals_are_capped' => $this->totals_are_capped,
            'data' => $this->data !== null ? array_map(fn (\Facturapi\Models\UnitCatalogResult $i): array => $i->toArray(), $this->data) : null
        ], fn (int|string|bool|array|null $v): bool => $v !== null);
    }
}
