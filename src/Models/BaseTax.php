<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class BaseTax
{
    public function __construct(
        public float $rate,
        public ?float $base = null,
        public ?string $type = null,
        public ?string $factor = null,
        public ?bool $withholding = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        if ((isset($data['type']) && strtoupper((string) $data['type']) === 'IEPS') || isset($data['ieps_mode'])) {
            return IepsTax::fromArray($data);
        }

        return new self(
            (float) ($data['rate'] ?? 0.0),
            isset($data['base']) ? (float) $data['base'] : null,
            isset($data['type']) ? (string) $data['type'] : null,
            isset($data['factor']) ? (string) $data['factor'] : null,
            isset($data['withholding']) ? (bool) $data['withholding'] : null
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
        ], fn (float|string|bool|null $v): bool => $v !== null);
    }
}
