<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class LineItemTrasladoInput
{
    public function __construct(
        public ?float $quantity = null,
        public mixed $product = null,
        public ?array $customs_keys = null,
        public ?string $complement = null,

        /** @var \Facturapi\Models\PartInput[]|null */
        public ?array $parts = null,
        public ?array $third_party = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['quantity'] ?? 0,
            $data['product'] ?? '',
            $data['customs_keys'] ?? [],
            $data['complement'] ?? null,
            isset($data['parts']) && is_array($data['parts']) ? array_map(fn ($i): mixed => is_array($i) ? \Facturapi\Models\PartInput::fromArray($i) : $i, $data['parts']) : [],
            $data['third_party'] ?? []
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'quantity' => $this->quantity,
            'product' => $this->product,
            'customs_keys' => $this->customs_keys,
            'complement' => $this->complement,
            'parts' => $this->parts !== null ? array_map(fn (\Facturapi\Models\PartInput $i): array => $i->toArray(), $this->parts) : null,
            'third_party' => $this->third_party
        ], fn ($v): bool => $v !== null);
    }
}
