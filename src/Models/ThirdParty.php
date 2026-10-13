<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ThirdParty
{
    public function __construct(
        public ?string $legal_name = null,
        public ?string $tax_id = null,
        public ?string $tax_system = null,
        public ?string $zip = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['legal_name'] ?? null,
            $data['tax_id'] ?? null,
            $data['tax_system'] ?? null,
            $data['zip'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'legal_name' => $this->legal_name,
            'tax_id' => $this->tax_id,
            'tax_system' => $this->tax_system,
            'zip' => $this->zip
        ], fn (?string $v): bool => $v !== null);
    }
}
