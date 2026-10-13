<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaReceptorNestedInput
{
    public function __construct(
        public ?array $sub_contratacion = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['sub_contratacion'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'sub_contratacion' => $this->sub_contratacion
        ], fn (?array $v): bool => $v !== null);
    }
}
