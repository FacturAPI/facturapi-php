<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class SignedDownloadUrl
{
    public function __construct(
        public string $url,
        public string $expires_at,
        public string $content_type,
        public string $filename,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['url'] ?? '',
            $data['expires_at'] ?? '',
            $data['content_type'] ?? '',
            $data['filename'] ?? ''
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'url' => $this->url,
            'expires_at' => $this->expires_at,
            'content_type' => $this->content_type,
            'filename' => $this->filename
        ], fn (string $v): true => $v !== null);
    }
}
