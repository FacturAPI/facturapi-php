<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationAddress
{
    public function __construct(
        public ?string $street = null,
        public ?string $exterior = null,
        public ?string $interior = null,
        public ?string $neighborhood = null,
        public ?string $city = null,
        public ?string $municipality = null,
        public ?string $zip = null,
        public ?string $state = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['street'] ?? null,
            $data['exterior'] ?? null,
            $data['interior'] ?? null,
            $data['neighborhood'] ?? null,
            $data['city'] ?? null,
            $data['municipality'] ?? null,
            $data['zip'] ?? null,
            $data['state'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'street' => $this->street,
            'exterior' => $this->exterior,
            'interior' => $this->interior,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'municipality' => $this->municipality,
            'zip' => $this->zip,
            'state' => $this->state
        ], fn (?string $v): bool => $v !== null);
    }
}
