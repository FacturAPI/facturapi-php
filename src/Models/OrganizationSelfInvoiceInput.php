<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationSelfInvoiceInput
{
    public function __construct(
        public ?array $allowed_cfdi_uses = null,
        public ?bool $apply_resico_isr = null,
        public ?string $support_email = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['allowed_cfdi_uses'] ?? [],
            $data['apply_resico_isr'] ?? false,
            $data['support_email'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'allowed_cfdi_uses' => $this->allowed_cfdi_uses,
            'apply_resico_isr' => $this->apply_resico_isr,
            'support_email' => $this->support_email
        ], fn (bool|string|array|null $v): bool => $v !== null);
    }
}
