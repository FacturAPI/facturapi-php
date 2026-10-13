<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationDomainInput
{
    public function __construct(
        public \Facturapi\Models\DomainField $domain,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['domain']) && is_array($data['domain']) ? \Facturapi\Models\DomainField::fromArray($data['domain']) : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'domain' => $this->domain?->toArray()
        ], fn ($v): bool => $v !== null);
    }
}
