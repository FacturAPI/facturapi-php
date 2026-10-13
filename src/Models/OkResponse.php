<?php

declare(strict_types=1);

namespace Facturapi\Models;

readonly class OkResponse
{
    public bool $ok;
    public bool $success;

    public function __construct(
        bool $ok = false,
        ?bool $success = null,
    ) {
        $this->ok = $ok;
        $this->success = $success ?? $ok;
    }

    public static function fromArray(array $data): self
    {
        $val = (bool) ($data['ok'] ?? $data['success'] ?? false);

        return new self($val, $val);
    }

    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
            'success' => $this->success,
        ];
    }
}
