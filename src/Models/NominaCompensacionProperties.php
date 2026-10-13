<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class NominaCompensacionProperties
{
    public function __construct(
        public ?float $saldo_a_favor = null,
        public ?int $ano = null,
        public ?float $remanente_sal_fav = null,
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
        ], fn (int|float|null $v): bool => $v !== null);
    }
}
