<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class SuccessResponse
{
    public bool $success;
    public bool $ok;

    public function __construct(
        bool $success = false,
        ?bool $ok = null,
    ) {
        $this->success = $success;
        $this->ok = $ok ?? $success;
    }

    public static function fromArray(array $data): self
    {
        $val = (bool) ($data['success'] ?? $data['ok'] ?? false);

        return new self($val, $val);
    }

    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'ok' => $this->ok,
        ];
    }
}
