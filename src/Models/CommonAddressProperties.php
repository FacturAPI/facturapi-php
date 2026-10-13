<?php

declare(strict_types=1);

namespace Facturapi\Models;

use ArrayAccess;
use BadMethodCallException;

/**
 * @implements ArrayAccess<string, ?string>
 */
readonly class CommonAddressProperties implements ArrayAccess
{
    public function __construct(
        public ?string $street = null,
        public ?string $exterior = null,
        public ?string $interior = null,
        public ?string $neighborhood = null,
        public ?string $city = null,
        public ?string $municipality = null,
        public ?string $zip = null,
        public ?string $state = null,
        public ?string $country = null,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['street'] ?? null,
            $data['exterior'] ?? null,
            $data['interior'] ?? null,
            $data['neighborhood'] ?? null,
            $data['city'] ?? null,
            $data['municipality'] ?? null,
            $data['zip'] ?? null,
            $data['state'] ?? null,
            $data['country'] ?? null,
        );
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return array_filter([
            'street' => $this->street,
            'exterior' => $this->exterior,
            'interior' => $this->interior,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'municipality' => $this->municipality,
            'zip' => $this->zip,
            'state' => $this->state,
            'country' => $this->country,
        ], fn (?string $v): bool => $v !== null);
    }

    public function offsetExists(mixed $offset): bool
    {
        return is_string($offset) && match ($offset) {
            'street' => $this->street !== null,
            'exterior' => $this->exterior !== null,
            'interior' => $this->interior !== null,
            'neighborhood' => $this->neighborhood !== null,
            'city' => $this->city !== null,
            'municipality' => $this->municipality !== null,
            'zip' => $this->zip !== null,
            'state' => $this->state !== null,
            'country' => $this->country !== null,
            default => false,
        };
    }

    public function offsetGet(mixed $offset): ?string
    {
        if (!is_string($offset)) {
            return null;
        }

        return match ($offset) {
            'street' => $this->street,
            'exterior' => $this->exterior,
            'interior' => $this->interior,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'municipality' => $this->municipality,
            'zip' => $this->zip,
            'state' => $this->state,
            'country' => $this->country,
            default => null,
        };
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new BadMethodCallException('Cannot modify readonly address properties.');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new BadMethodCallException('Cannot modify readonly address properties.');
    }
}
