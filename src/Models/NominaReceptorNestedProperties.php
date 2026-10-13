<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaReceptorNestedProperties
{
    public function __construct(

        /** @var \Facturapi\Models\NominaSubContratacionProperties[]|null */
        public ?array $sub_contratacion = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['sub_contratacion']) && is_array($data['sub_contratacion']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\NominaSubContratacionProperties::fromArray($i) : $i, $data['sub_contratacion']) : []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'sub_contratacion' => $this->sub_contratacion !== null ? array_map(fn (\Facturapi\Models\NominaSubContratacionProperties $i): array => $i->toArray(), $this->sub_contratacion) : null
        ], fn (?array $v): bool => $v !== null);
    }
}
