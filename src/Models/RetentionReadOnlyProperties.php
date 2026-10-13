<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class RetentionReadOnlyProperties
{
    public function __construct(
        public ?string $status = null,
        public ?string $verification_url = null,
        public ?string $type = null,
        public ?string $uuid = null,
        public ?\Facturapi\Models\Stamp $stamp = null,
        public ?\Facturapi\Models\CustomerInfo $customer = null,
        public ?bool $is_ready_to_stamp = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['status'] ?? null,
            $data['verification_url'] ?? null,
            $data['type'] ?? null,
            $data['uuid'] ?? null,
            isset($data['stamp']) && is_array($data['stamp']) ? \Facturapi\Models\Stamp::fromArray($data['stamp']) : null,
            isset($data['customer']) && is_array($data['customer']) ? \Facturapi\Models\CustomerInfo::fromArray($data['customer']) : null,
            $data['is_ready_to_stamp'] ?? false
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'status' => $this->status,
            'verification_url' => $this->verification_url,
            'type' => $this->type,
            'uuid' => $this->uuid,
            'stamp' => $this->stamp?->toArray(),
            'customer' => $this->customer?->toArray(),
            'is_ready_to_stamp' => $this->is_ready_to_stamp
        ], fn (string|bool|array|null $v): bool => $v !== null);
    }
}
