<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class LeyendasFiscalesData
{
    public function __construct(
        public array $leyendas,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['leyendas'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'leyendas' => $this->leyendas
        ], fn (array $v): true => $v !== null);
    }
}
