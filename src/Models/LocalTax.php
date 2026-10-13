<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class LocalTax
{
    public function __construct(
        public float $rate,
        public ?float $base = null,
        public string $type = '',
        public ?bool $withholding = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            (float) ($data['rate'] ?? 0.0),
            isset($data['base']) ? (float) $data['base'] : null,
            isset($data['type']) ? (string) $data['type'] : '',
            isset($data['withholding']) ? (bool) $data['withholding'] : null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'rate' => $this->rate,
            'base' => $this->base,
            'type' => $this->type,
            'withholding' => $this->withholding,
        ], fn (float|string|bool|null $v): bool => $v !== null);
    }
}
