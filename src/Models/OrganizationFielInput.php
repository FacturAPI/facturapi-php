<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationFielInput
{
    public function __construct(
        public string $cer,
        public string $key,
        public string $password,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['cer'] ?? '',
            $data['key'] ?? '',
            $data['password'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'cer' => $this->cer,
            'key' => $this->key,
            'password' => $this->password
        ], fn (string $v): true => $v !== null);
    }
}
