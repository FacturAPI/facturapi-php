<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class Stamp
{
    public function __construct(
        public ?string $signature = null,
        public ?string $date = null,
        public ?string $sat_cert_number = null,
        public ?string $sat_signature = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['signature'] ?? null,
            $data['date'] ?? null,
            $data['sat_cert_number'] ?? null,
            $data['sat_signature'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'signature' => $this->signature,
            'date' => $this->date,
            'sat_cert_number' => $this->sat_cert_number,
            'sat_signature' => $this->sat_signature
        ], fn (?string $v): bool => $v !== null);
    }
}
