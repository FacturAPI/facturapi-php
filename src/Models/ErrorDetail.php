<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class ErrorDetail
{
    public function __construct(
        public string $message,
        public string $code,
        public ?string $location = null,
        public ?string $path = null,
        public string $source = '',
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['message'] ?? '',
            $data['code'] ?? '',
            $data['location'] ?? null,
            $data['path'] ?? null,
            $data['source'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'message' => $this->message,
            'code' => $this->code,
            'location' => $this->location,
            'path' => $this->path,
            'source' => $this->source
        ], fn (?string $v): bool => $v !== null);
    }
}
