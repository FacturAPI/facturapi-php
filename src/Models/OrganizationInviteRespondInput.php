<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OrganizationInviteRespondInput
{
    public function __construct(
        public bool $accept,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['accept'] ?? false
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'accept' => $this->accept
        ], fn (bool $v): true => $v !== null);
    }
}
