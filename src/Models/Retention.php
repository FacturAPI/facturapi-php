<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class Retention
{
    public function __construct(
        public string $id,
        public string $created_at,
        public bool $livemode,
        public ?string $status = null,
        public ?string $verification_url = null,
        public ?string $type = null,
        public ?string $uuid = null,
        public ?\Facturapi\Models\Stamp $stamp = null,
        public ?\Facturapi\Models\CustomerInfo $customer = null,
        public ?bool $is_ready_to_stamp = null,
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

        /** @var \Facturapi\Models\NamespaceProperties[]|null */
        public ?array $namespaces = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? '',
            $data['created_at'] ?? '',
            $data['livemode'] ?? false,
            $data['status'] ?? null,
            $data['verification_url'] ?? null,
            $data['type'] ?? null,
            $data['uuid'] ?? null,
            isset($data['stamp']) && is_array($data['stamp']) ? \Facturapi\Models\Stamp::fromArray($data['stamp']) : null,
            isset($data['customer']) && is_array($data['customer']) ? \Facturapi\Models\CustomerInfo::fromArray($data['customer']) : null,
            $data['is_ready_to_stamp'] ?? false,
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
            isset($data['namespaces']) && is_array($data['namespaces']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NamespaceProperties::fromArray($i) : $i, $data['namespaces']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'livemode' => $this->livemode,
            'status' => $this->status,
            'verification_url' => $this->verification_url,
            'type' => $this->type,
            'uuid' => $this->uuid,
            'stamp' => $this->stamp?->toArray(),
            'customer' => $this->customer?->toArray(),
            'is_ready_to_stamp' => $this->is_ready_to_stamp,
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
            'namespaces' => $this->namespaces !== null ? array_map(fn (\Facturapi\Models\NamespaceProperties $i): array => $i->toArray(), $this->namespaces) : null
        ], fn (bool|string|array|null $v): bool => $v !== null);
    }
}
