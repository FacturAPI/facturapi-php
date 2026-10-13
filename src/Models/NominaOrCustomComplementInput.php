<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaOrCustomComplementInput
{
    public function __construct(
        public string $type,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type
        ], fn (string $v): true => $v !== null);
    }
}
