<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ErrorMessage
{
    public function __construct(
        public string $message,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['message'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'message' => $this->message
        ], fn (string $v): true => $v !== null);
    }
}
