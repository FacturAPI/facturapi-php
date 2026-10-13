<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class RetentionUpdateInput
{
    public function __construct(
        public ?string $status = null,
        public mixed $customer = null,
        public ?string $cve_retenc = null,
        public ?string $fecha_exp = null,
        public ?string $desc_retenc = null,
        public ?string $folio_int = null,
        public ?array $periodo = null,
        public ?array $totales = null,
        public ?string $external_id = null,
        public ?string $idempotency_key = null,

        /** @var \Facturapi\Models\CustomComplementData[]|null */
        public ?array $complements = null,
        public ?string $pdf_custom_section = null,
        public ?string $addenda = null,
        public ?array $namespaces = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['status'] ?? null,
            $data['customer'] ?? null,
            $data['cve_retenc'] ?? null,
            $data['fecha_exp'] ?? null,
            $data['desc_retenc'] ?? null,
            $data['folio_int'] ?? null,
            $data['periodo'] ?? [],
            $data['totales'] ?? [],
            $data['external_id'] ?? null,
            $data['idempotency_key'] ?? null,
            isset($data['complements']) && is_array($data['complements']) ? array_map(fn ($i) => is_array($i) ? \Facturapi\Models\CustomComplementData::fromArray($i) : $i, $data['complements']) : [],
            $data['pdf_custom_section'] ?? null,
            $data['addenda'] ?? null,
            $data['namespaces'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'status' => $this->status,
            'customer' => $this->customer,
            'cve_retenc' => $this->cve_retenc,
            'fecha_exp' => $this->fecha_exp,
            'desc_retenc' => $this->desc_retenc,
            'folio_int' => $this->folio_int,
            'periodo' => $this->periodo,
            'totales' => $this->totales,
            'external_id' => $this->external_id,
            'idempotency_key' => $this->idempotency_key,
            'complements' => $this->complements !== null ? array_map(fn (\Facturapi\Models\CustomComplementData $i) => $i->toArray(), $this->complements) : null,
            'pdf_custom_section' => $this->pdf_custom_section,
            'addenda' => $this->addenda,
            'namespaces' => $this->namespaces
        ], fn ($v): bool => $v !== null);
    }
}
