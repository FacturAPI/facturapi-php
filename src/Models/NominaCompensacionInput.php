<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaCompensacionInput
{
    public function __construct(
        public float $saldo_a_favor,
        public int $ano,
        public float $remanente_sal_fav,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['saldo_a_favor'] ?? 0,
            $data['ano'] ?? 0,
            $data['remanente_sal_fav'] ?? 0
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'saldo_a_favor' => $this->saldo_a_favor,
            'ano' => $this->ano,
            'remanente_sal_fav' => $this->remanente_sal_fav
        ], fn (int|float $v): true => $v !== null);
    }
}
