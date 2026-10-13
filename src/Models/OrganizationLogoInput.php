<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationLogoInput
{
    public function __construct(
        public string $file,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['file'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'file' => $this->file
        ], fn (string $v): true => $v !== null);
    }
}
