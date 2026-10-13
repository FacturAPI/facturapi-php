<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class IepsTax extends BaseTax
{
    public function __construct(
        float $rate,
        ?float $base = null,
        ?string $type = 'IEPS',
        ?string $factor = null,
        ?bool $withholding = null,
        public ?string $ieps_mode = null,
    ) {
        parent::__construct($rate, $base, $type, $factor, $withholding);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            (float) ($data['rate'] ?? 0.0),
            isset($data['base']) ? (float) $data['base'] : null,
            isset($data['type']) ? (string) $data['type'] : 'IEPS',
            isset($data['factor']) ? (string) $data['factor'] : null,
            isset($data['withholding']) ? (bool) $data['withholding'] : null,
            isset($data['ieps_mode']) ? (string) $data['ieps_mode'] : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'rate' => $this->rate,
            'base' => $this->base,
            'type' => $this->type,
            'factor' => $this->factor,
            'withholding' => $this->withholding,
            'ieps_mode' => $this->ieps_mode,
        ], fn (float|bool|string|null $v): bool => $v !== null);
    }
}
