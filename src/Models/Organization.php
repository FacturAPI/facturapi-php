<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class Organization
{
    public function __construct(
        public ?string $id = null,
        public ?string $logo_url = null,
        public ?string $timezone = null,
        public ?string $created_at = null,
        public ?bool $is_production_ready = null,
        public ?array $pending_steps = null,
        public ?array $legal = null,
        public ?array $customization = null,
        public ?array $certificate = null,
        public ?array $fiel = null,
        public ?array $receipts = null,
        public ?array $self_invoice = null,
        public ?string $name = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['logo_url'] ?? null,
            $data['timezone'] ?? null,
            $data['created_at'] ?? null,
            $data['is_production_ready'] ?? false,
            $data['pending_steps'] ?? [],
            $data['legal'] ?? [],
            $data['customization'] ?? [],
            $data['certificate'] ?? [],
            $data['fiel'] ?? [],
            $data['receipts'] ?? [],
            $data['self_invoice'] ?? [],
            $data['name'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'name' => $this->name,
            'logo_url' => $this->logo_url,
            'timezone' => $this->timezone,
            'created_at' => $this->created_at,
            'is_production_ready' => $this->is_production_ready,
            'pending_steps' => $this->pending_steps,
            'legal' => $this->legal,
            'customization' => $this->customization,
            'certificate' => $this->certificate,
            'fiel' => $this->fiel,
            'receipts' => $this->receipts,
            'self_invoice' => $this->self_invoice
        ], fn ($v): bool => $v !== null);
    }
}
